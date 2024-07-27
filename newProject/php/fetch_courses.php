<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses
$courses_query = "SELECT course_name, entry_level, scheme FROM courses";
$courses_result = $conn->query($courses_query);

$courses = [];

if ($courses_result->num_rows > 0) {
    while ($course = $courses_result->fetch_assoc()) {
        $courses[] = [
            'course_name' => $course['course_name'],
            'entry_level' => $course['entry_level'],
            'scheme' => $course['scheme']
        ];
    }
}

// Set header to return JSON
header('Content-Type: application/json');
echo json_encode($courses);

$conn->close();
?>
