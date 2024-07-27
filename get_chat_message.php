<?php
// get_chat_messages.php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch chat messages
$sql = "SELECT user_message, bot_response, sender FROM chat_messages";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = [
            'message' => $row['sender'] === 'admin' ? $row['user_message'] : $row['bot_response'],
            'sender' => $row['sender'] === 'admin' ? 'admin' : 'user'
        ];
    }
}
$conn->close();

echo json_encode($messages);
?>
