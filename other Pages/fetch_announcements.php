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

// Fetch announcements
$sql = "SELECT id, title, date_posted, LEFT(content, 100) AS small_details FROM announcements ORDER BY date_posted DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="list-group">';
    while ($row = $result->fetch_assoc()) {
        echo '<a href="announcement_details.php?id=' . $row['id'] . '" class="list-group-item list-group-item-action">';
        echo '<h5 class="mb-1">' . htmlspecialchars($row['title']) . '</h5>';
        echo '<p class="mb-1">' . htmlspecialchars($row['small_details']) . '...</p>';
        echo '<small>' . htmlspecialchars($row['date_posted']) . '</small>';
        echo '<button class="btn btn-primary btn-sm float-right">View More</button>';
        echo '</a>';
    }
    echo '</div>';
} else {
    echo '<p>No announcements available.</p>';
}

$conn->close();
?>
