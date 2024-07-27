<?php
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

// Query to fetch CenterNo and Center_Name from sec_schools table
$query = "SELECT CenterNo, Center_Name FROM sec_schools";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error preparing statement: ' . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch data as associative array
$schools = [];
while ($row = $result->fetch_assoc()) {
    $schools[] = $row;
}

?>