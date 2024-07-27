<?php
session_start();

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

// SQL query to fetch applications
$sql = "SELECT Salutation, Surname, OtherNames, Sex, Email, Telephone, EntryType, Course, createDate AS creationDate, FormID,Status
        FROM applications
        WHERE YEAR(createDate) = YEAR(CURDATE())"; // Fetch applications for the current year

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error preparing statement: ' . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

$applications = array();
while ($row = $result->fetch_assoc()) {
    $applications[] = $row;
}

$stmt->close();

echo json_encode($applications); // Output JSON encoded array
?>
