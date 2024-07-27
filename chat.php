<?php
// chat.php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$userMessage = $data['message'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate response based on user message
$response = '';
switch (strtolower($userMessage)) {
    case 'hello':
    case 'hi':
        $response = 'Hello! How can I assist you today?';
        break;
    case 'help':
        $response = 'Sure, I\'m here to help. What do you need assistance with?';
        break;
    case 'bye':
        $response = 'Goodbye! Have a great day!';
        break;
    default:
        $response = 'I\'m not sure how to respond to that. Can you please clarify?';
        break;
}

// Save to database
$stmt = $conn->prepare("INSERT INTO chat_messages (user_message, bot_response) VALUES (?, ?)");
$stmt->bind_param("ss", $userMessage, $response);
$stmt->execute();
$stmt->close();
$conn->close();

// Send response back to client
echo json_encode(['message' => $response]);
?>
