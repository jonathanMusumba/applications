<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Fetch the current password for the user
$sql = "SELECT password FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($oldPassword, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Old password is incorrect']);
    exit();
}

// Validate new password
if (strlen($newPassword) < 6) {
    echo json_encode(['success' => false, 'message' => 'New password must be at least 6 characters']);
    exit();
}

// Hash the new password and update in the database
$newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
$sql = "UPDATE Users SET password = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newPasswordHash, $user_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Password changed successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to change password']);
}

// Close the connection
$stmt->close();
$conn->close();
?>
