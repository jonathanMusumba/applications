<?php
session_start();

$error = '';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admitted_applicants.php</title>
</head>
<body>
    <h1>admitted_applicants.php</h1>
    <p>Content related to admitted_applicants.php</p>
</body>
</html>