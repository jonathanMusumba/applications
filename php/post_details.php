<?php
include 'db.php';
session_start();

if (!isset($_GET['post_id']) || !filter_var($_GET['post_id'], FILTER_VALIDATE_INT)) {
    echo "<p>Invalid post ID.</p>";
    exit;
}

$post_id = (int)$_GET['post_id'];
// Fetch post details
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$post) {
    echo "<p>Post not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .comments { margin-top: 20px; }
        .comment { margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

    <h2>Comments <i class="fa fa-comment"></i></h2>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="comment_form.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Submit Comment">
        </form>
    <?php else: ?>
        <p>You must be logged in to comment.</p>
    <?php endif; ?>

    <div class="comments">
        <?php
        // Fetch and display comments
        $stmt = $conn->prepare("SELECT c.comment, c.created_at, cm.name FROM comments c
                                JOIN commenters cm ON c.commenter_id = cm.id
                                WHERE c.post_id = ?
                                ORDER BY c.created_at DESC");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<div class='comment'>";
            echo "<p><strong>" . htmlspecialchars($row['name']) . ":</strong> " . htmlspecialchars($row['comment']) . "</p>";
            echo "<p><small>Posted on " . htmlspecialchars($row['created_at']) . "</small></p>";
            echo "</div>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
