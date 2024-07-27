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

// Fetch advertisements
$sql = "SELECT title, media_path, link FROM advertisements ORDER BY date_posted DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="carousel-item active">';
    while ($row = $result->fetch_assoc()) {
        $media_path = isset($row['media_path']) ? htmlspecialchars($row['media_path']) : 'path/to/default/image.jpg'; // Default image path
        echo '<div class="carousel-item">';
        echo '<a href="' . htmlspecialchars($row['link']) . '" target="_blank">';
        echo '<img class="d-block w-100" src="' . $media_path . '" alt="' . htmlspecialchars($row['title']) . '">';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>No advertisements available.</p>';
}

$conn->close();
?>
