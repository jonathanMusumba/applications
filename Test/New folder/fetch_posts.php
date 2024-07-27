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
$posts_sql = "SELECT posts.*, categories.name AS category_name FROM posts LEFT JOIN categories ON posts.category_id = categories.id";
if ($category_id > 0) {
    $posts_sql .= " WHERE posts.category_id = $category_id";
}
$posts_sql .= " ORDER BY posts.date_posted DESC";
$posts_result = $conn->query($posts_sql);

echo '<div class="container mt-4">';
echo '<div class="row">';
while ($post = $posts_result->fetch_assoc()) {
    $media_path = isset($post['media_path']) ? htmlspecialchars($post['media_path']) : 'path/to/default/image.jpg'; // Set default image path
    echo '<div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="' . $media_path . '" alt="' . htmlspecialchars($post['title']) . '">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($post['title']) . '</h5>
                    <p class="card-text">' . htmlspecialchars($post['content']) . '</p>
                    <p class="card-text"><small class="text-muted">Category: ' . htmlspecialchars($post['category_name']) . '</small></p>
                </div>
            </div>
          </div>';
}
echo '</div>';
echo '</div>';

$conn->close();
?>
