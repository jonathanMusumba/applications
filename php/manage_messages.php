<?php
// Include database connection
include __DIR__ . '/../db_connection/db_connection.php';

// Function to fetch all messages
function fetchMessages($conn) {
    $sql = "SELECT id, sender, email, message, status, message_type, created_at FROM messages ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $messages = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    return $messages;
}

// Function to fetch deleted messages (if needed)
function fetchDeletedMessages($conn) {
    $sql = "SELECT m.id, m.sender, m.email, m.message, m.status, m.message_type, m.created_at
            FROM messages m
            INNER JOIN deleted_messages dm ON m.id = dm.message_id
            ORDER BY dm.deleted_at DESC";
    $result = $conn->query($sql);

    $deletedMessages = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $deletedMessages[] = $row;
        }
    }

    return $deletedMessages;
}

// Function to fetch replies (if needed)
function fetchReplies($conn, $messageId) {
    $sql = "SELECT reply_message, replied_at FROM replies WHERE message_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    $result = $stmt->get_result();

    $replies = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $replies[] = $row;
        }
    }

    $stmt->close();
    return $replies;
}

// Handle actions based on $_GET or $_POST requests
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Fetch messages based on type (Sent/Received)
    if (isset($_GET['message_type']) && ($_GET['message_type'] === 'Sent' || $_GET['message_type'] === 'Received')) {
        $messageType = $_GET['message_type'];
        $sql = "SELECT id, sender, email, message, status, message_type, created_at FROM messages WHERE message_type = ? ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $messageType);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
        }

        $stmt->close();
    } else {
        // Fetch all messages
        $messages = fetchMessages($conn);
    }

    // Output JSON response
    echo json_encode(['status' => 'success', 'messages' => $messages]);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle actions like deleting messages, replying to messages, etc.
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Example: Delete message
        if ($action === 'delete_message' && isset($_POST['message_id'])) {
            $messageId = $_POST['message_id'];
            $sql = "DELETE FROM messages WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $messageId);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Message deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error deleting message.']);
            }
            $stmt->close();
        }

        // Add more actions like replying to message, marking as read, etc.
    }
}

// Close database connection
$conn->close();
?>
