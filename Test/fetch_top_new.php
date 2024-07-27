<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch top posts by engagement
$sql = "
    SELECT p.id, p.title, p.content, COUNT(r.id) AS reaction_count
    FROM posts p
    LEFT JOIN reactions r ON p.id = r.post_id
    GROUP BY p.id
    ORDER BY reaction_count DESC
    LIMIT 5
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                    <p class="card-text">' . htmlspecialchars($row['content']) . '</p>
                    <p class="card-text"><small class="text-muted">Reactions: ' . $row['reaction_count'] . '</small></p>
                </div>
            </div>
        ';
    }
} else {
    echo '<p>No top news available.</p>';
}

$conn->close();
?>
