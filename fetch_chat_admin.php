<?php
// admin.php
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, user_message, bot_response, timestamp FROM chat_messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>User Message</th>
<th>Bot Response</th>
<th>Timestamp</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['user_message'] . "</td>";
    echo "<td>" . $row['bot_response'] . "</td>";
    echo "<td>" . $row['timestamp'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
