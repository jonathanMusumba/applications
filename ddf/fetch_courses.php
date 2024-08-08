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

// Fetch courses from the database
$query = "SELECT course_id, course_name, Duration, Entry_level, Scheme, Tuition FROM Courses";
$result = $conn->query($query);

$courses = [];
$courseCount = 0; // Initialize course count

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
        $courseCount++; // Increment course count
    }
}

// Return courses and count as JSON response
header('Content-Type: application/json');
$response = [
    'courses' => $courses,
    'courseCount' => $courseCount
];
echo json_encode($response);

$conn->close();
?>
