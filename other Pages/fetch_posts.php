<?php
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

// Fetch categories
$categories_sql = "SELECT * FROM categories";
$categories_result = $conn->query($categories_sql);

echo '<ul class="nav nav-tabs">';
while ($category = $categories_result->fetch_assoc()) {
    echo '<li class="nav-item">
            <a class="nav-link" href="index.php?category_id=' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</a>
          </li>';
}
echo '</ul>';

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Fetch posts with comment counts
$posts_sql = "
    SELECT posts.*, categories.name AS category_name, 
           COALESCE(COUNT(comments.id), 0) AS comment_count
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    LEFT JOIN comments ON posts.id = comments.post_id
";

if ($category_id > 0) {
    $posts_sql .= " WHERE posts.category_id = $category_id";
}

$posts_sql .= "
    GROUP BY posts.id
    ORDER BY posts.date_posted DESC
    LIMIT 15
";
$posts_result = $conn->query($posts_sql);

echo '<div class="container mt-4">';
echo '<div class="row">';
while ($post = $posts_result->fetch_assoc()) {
    $media_path = isset($post['media_url']) ? htmlspecialchars($post['media_url']) : ''; // Check for media path
    $media_height = '150px'; // Adjusted height for media
    $content = htmlspecialchars($post['content']);
    $short_content = strlen($content) > 100 ? substr($content, 0, 100) . '...' : $content; // Shortened content
    $date_posted = htmlspecialchars(date('F j, Y', strtotime($post['date_posted']))); // Format date
    $comment_count = intval($post['comment_count']); // Ensure integer value

    echo '<div class="col-md-4 mb-4">
            <div class="card h-100"> <!-- Use h-100 to ensure card takes full height -->
                ' . ($media_path ? '<img class="card-img-top" src="' . $media_path . '" alt="' . htmlspecialchars($post['title']) . '" style="height: ' . $media_height . '; object-fit: cover;">' : '') . '
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">' . htmlspecialchars($post['title']) . '</h5>
                    <p class="card-text flex-grow-1">' . $short_content . '</p> <!-- flex-grow-1 to ensure text fits properly -->
                    <p class="card-text"><small class="text-muted">Date Posted: ' . $date_posted . '</small></p>
                    <p class="card-text mt-auto"><i class="fas fa-comments"></i> ' . $comment_count . ' Comments</p>
                    <a href="post.php?id=' . $post['id'] . '" class="btn btn-primary mt-2">Read More</a>
                    <p class="card-text mt-2"><small class="text-muted">Category: ' . htmlspecialchars($post['category_name']) . '</small></p>
                </div>
            </div>
          </div>';
}
echo '</div>'; // Close row
echo '</div>'; // Close container

$conn->close();
?>
