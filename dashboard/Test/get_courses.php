<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connection.php';

// Get the MySQLi instance
$mysqli = getDbConnection();

// Check if the course parameter is set
if (isset($_GET['course'])) {
    $courseName = $mysqli->real_escape_string($_GET['course']);

    // Prepare the SQL query
    $query = "SELECT scheme, entry_level FROM courses WHERE course_name = '$courseName'";

    // Execute the query
    $result = $mysqli->query($query);

    // Check if the course data was found
    if ($result && $result->num_rows > 0) {
        $courseData = $result->fetch_assoc();
        echo json_encode($courseData);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Course not found']);
    }

    // Free the result set and close the connection
    $result->free();
    $mysqli->close();
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No course specified']);
}
?>
