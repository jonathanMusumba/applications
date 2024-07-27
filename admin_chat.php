<?php
// admin_chat.php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$adminMessage = $data['message'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save admin message to database
$stmt = $conn->prepare("INSERT INTO chat_messages (user_message, bot_response, sender) VALUES (?, '', 'admin')");
$stmt->bind_param("s", $adminMessage);
$stmt->execute();
$stmt->close();
$conn->close();

// Send response back to client
echo json_encode(['status' => 'success']);
?>
