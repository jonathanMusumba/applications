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

// Fetch posts with category "News"
$sql = "SELECT posts.id, posts.title, posts.content, posts.date_posted, posts.media_url, categories.name AS category_name 
        FROM posts 
        JOIN categories ON posts.category_id = categories.id 
        WHERE categories.name = 'News' 
        AND posts.status = 'Published' 
        ORDER BY posts.date_posted";
$result = $conn->query($sql);

// Check if any posts were returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display each post
        echo '<div class="card mb-4">';
        if (!empty($row['media'])) {
            echo '<img src="' . htmlspecialchars($row['media']) . '" class="card-img-top" alt="Media">';
        }
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
        echo '<p class="card-text">' . htmlspecialchars($row['content']) . '</p>';
        echo '<p class="card-text"><small class="text-muted">Published on ' . htmlspecialchars($row['date_created']) . '</small></p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No news posts available.</p>';
}

$conn->close();
?>
