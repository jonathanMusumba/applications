<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
try {
    $stmt = $conn->prepare('UPDATE applications SET Status = "admitted" WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    echo 'Student admitted successfully.';
} catch (Exception $e) {
    echo 'Error admitting student: ' . $e->getMessage();
}
?>
