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

$sql = "SELECT * FROM announcements ORDER BY date_announcement DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">' . htmlspecialchars($row['title']) . '</h5>
                <small class="text-muted">' . htmlspecialchars($row['date_announcement']) . '</small>
            </div>
            <p class="mb-1">' . htmlspecialchars($row['content']) . '</p>
            <small class="text-danger font-weight-bold">' . htmlspecialchars($row['status']) . '</small>
        </a>';
    }
} else {
    echo '<p class="list-group-item">No announcements found.</p>';
}

$conn->close();
?>
