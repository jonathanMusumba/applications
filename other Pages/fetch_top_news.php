<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch top news based on the number of comments
$top_news_sql = "
    SELECT p.title, p.date_posted, COUNT(c.id) AS comment_count
    FROM posts p
    LEFT JOIN comments c ON p.id = c.post_id
    JOIN categories cat ON p.category_id = cat.id
    WHERE cat.name = 'new'
    GROUP BY p.id
    ORDER BY comment_count DESC, p.date_posted DESC
";
$top_news_result = $conn->query($top_news_sql);

if ($top_news_result === false) {
    die('Query error: ' . $conn->error);
}

echo '<div class="container mt-4">';
echo '<h3>Top News</h3>';
echo '<ul class="list-unstyled">';

if ($top_news_result->num_rows > 0) {
    while ($news = $top_news_result->fetch_assoc()) {
        $title = htmlspecialchars($news['title']);
        $date_posted = htmlspecialchars(date('F j, Y', strtotime($news['date_posted'])));
        $comment_count = htmlspecialchars($news['comment_count']);

        echo '<li class="media mb-4">';
        echo '    <div class="media-body">';
        echo '        <h5 class="mt-0 mb-1">' . $title . '</h5>';
        echo '        <small class="text-muted">' . $date_posted . '</small>';
        echo '        <span class="float-right">';
        echo '            <i class="fas fa-comments"></i> ' . $comment_count;
        echo '        </span>';
        echo '    </div>';
        echo '</li>';
    }
} else {
    echo '<li>No news available.</li>';
}

echo '</ul>';
echo '</div>';

$conn->close();
?>
