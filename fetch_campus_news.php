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

// Fetch posts with category "News" and count comments
$sql = "
    SELECT p.id, p.title, p.content, p.date_posted, p.media_url, c.name AS category_name, 
           COUNT(cm.id) AS comment_count
    FROM posts p
    JOIN categories c ON p.category_id = c.id
    LEFT JOIN comments cm ON p.id = cm.post_id
    WHERE c.name = 'News'
    AND p.status = 'Published'
    GROUP BY p.id
    ORDER BY p.date_posted DESC
";
$result = $conn->query($sql);

// Check if any posts were returned
if ($result->num_rows > 0) {
    echo '<div class="container mt-4">';
    echo '<div class="row">';
    
    while ($row = $result->fetch_assoc()) {
        $media_url = htmlspecialchars($row['media_url']);
        $title = htmlspecialchars($row['title']);
        $content = htmlspecialchars($row['content']);
        $date_posted = htmlspecialchars(date('F j, Y', strtotime($row['date_posted'])));
        $comment_count = intval($row['comment_count']); // Ensure integer value
        
        echo '<div class="col-md-4 mb-4">';
        echo '    <div class="card">';
        
        if (!empty($media_url)) {
            echo '        <img src="' . $media_url . '" class="card-img-top" alt="Media">';
        }
        
        echo '        <div class="card-body">';
        echo '            <h5 class="card-title">' . $title . '</h5>';
        echo '            <p class="card-text">' . substr($content, 0, 100) . '...</p>'; // Display a snippet of the content
        echo '            <p class="card-text"><small class="text-muted">Published on ' . $date_posted . '</small></p>';
        echo '            <p class="card-text"><i class="fas fa-comments"></i> ' . $comment_count . ' Comments</p>';
        echo '            <a href="post.php?id=' . $row['id'] . '" class="btn btn-primary">See More</a>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
    
    echo '</div>'; // Close row
    echo '</div>'; // Close container
} else {
    echo '<div class="container mt-4"><p>No news posts available.</p></div>';
}

$conn->close();
?>
