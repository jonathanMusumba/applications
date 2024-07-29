<?php
header('Content-Type: application/json');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

$conn = new mysqli($servername, $username, $password, $dbname);

$level = isset($_GET['level']) ? $_GET['level'] : '';
$scheme = isset($_GET['scheme']) ? $_GET['scheme'] : '';

error_log("Received parameters: Level = $level, Scheme = $scheme");

// Basic SQL query
$sql = "SELECT course_id, course_name FROM courses WHERE Entry_Level = ? AND scheme = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $level, $scheme);
$stmt->execute();
$result = $stmt->get_result();

$courses = array();
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

// Return JSON data
echo json_encode($courses);

$stmt->close();
$conn->close();
?>