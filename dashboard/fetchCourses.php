<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch course details
$sql = "SELECT course_name, Entry_Level, scheme FROM Courses";
$result = $conn->query($sql);

$courses = array();

if ($result->num_rows > 0) {
    // Fetch each row as an associative array
    while($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON data
echo json_encode($courses);

// Close the connection
$conn->close();
?>
