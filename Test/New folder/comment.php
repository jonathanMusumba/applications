<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle post creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_post'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $media = $conn->real_escape_string($_POST['media']); // Media URL or path

    $sql = "INSERT INTO posts (title, content, media) VALUES ('$title', '$content', '$media')";

    if ($conn->query($sql) === TRUE) {
        echo "Post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle comment posting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_comment'])) {
    $post_id = intval($_POST['post_id']);
    $comment = $conn->real_escape_string($_POST['comment']);

    if (!isset($_SESSION['user_id'])) {
        echo '<form method="POST" action="">
                <input type="hidden" name="post_id" value="' . $post_id . '">
                <input type="text" name="commenter_name" placeholder="Name" required>
                <input type="email" name="commenter_email" placeholder="Email" required>
                <textarea class="form-control" name="comment" rows="3" placeholder="Add a comment" required></textarea>
                <input type="hidden" name="action" value="register_and_comment">
                <button type="submit" class="btn btn-primary mt-2">Register and Comment</button>
              </form>';
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO comments (post_id, user_id, comment) VALUES ($post_id, $user_id, '$comment')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Comment added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle commenter registration and comment posting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'register_and_comment') {
    $post_id = intval($_POST['post_id']);
    $name = $conn->real_escape_string($_POST['commenter_name']);
    $email = $conn->real_escape_string($_POST['commenter_email']);
    $comment = $conn->real_escape_string($_POST['comment']);

    // Hash email for security
    $hashed_email = password_hash($email, PASSWORD_DEFAULT);

    // Register commenter
    $sql = "INSERT INTO commenters (name, email) VALUES ('$name', '$hashed_email')";

    if ($conn->query($sql) === TRUE) {
        // Fetch the new commenter ID
        $commenter_id = $conn->insert_id;

        // Add comment
        $sql = "INSERT INTO comments (post_id, commenter_id, comment) VALUES ($post_id, $commenter_id, '$comment')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Comment added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle reactions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_reaction'])) {
    $post_id = intval($_POST['post_id']);
    $reaction = $conn->real_escape_string($_POST['reaction']);

    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to react.";
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO reactions (post_id, user_id, reaction) VALUES ($post_id, $user_id, '$reaction')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Reaction added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch posts from database
$posts_query = "SELECT * FROM posts";
$posts_result = $conn->query($posts_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <!-- Create Post Form -->
        <h2>Create New Post</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="media">Media URL</label>
                <input type="text" class="form-control" id="media" name="media">
            </div>
            <button type="submit" class="btn btn-primary" name="create_post">Create Post</button>
        </form>

        <!-- Display Posts -->
        <h2 class="mt-4">Posts</h2>
        <?php while ($post = $posts_result->fetch_assoc()): ?>
            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                    <?php if (!empty($post['media'])): ?>
                        <img src="<?= htmlspecialchars($post['media']) ?>" class="d-block w-100" alt="Post Media">
                    <?php endif; ?>
                    <p class="card-text"><?= htmlspecialchars($post['content']) ?></p>
                    
                    <!-- Reaction Form -->
                    <form method="POST" action="">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <input type="text" name="reaction" placeholder="Your reaction">
                        <button type="submit" name="add_reaction" class="btn btn-secondary">React</button>
                    </form>

                    <!-- Display Comments -->
                    <h6 class="mt-3">Comments</h6>
                    <?php
                    // Fetch comments for this post
                    $comments_query = "SELECT * FROM comments WHERE post_id = " . $post['id'];
                    $comments_result = $conn->query($comments_query);
                    ?>
                    <?php while ($comment = $comments_result->fetch_assoc()): ?>
                        <div class="comment">
                            <p><strong>Commenter <?= htmlspecialchars($comment['user_id']) ?>:</strong> <?= htmlspecialchars($comment['comment']) ?></p>
                        </div>
                    <?php endwhile; ?>

                    <!-- Comment Form -->
                    <form method="POST" action="">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <textarea class="form-control" name="comment" rows="3" placeholder="Add a comment" required></textarea>
                        <button type="submit" name="post_comment" class="btn btn-primary mt-2">Post Comment</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
