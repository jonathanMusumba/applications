<?php
// save_course.php
include 'db_connection.php'; // Include your database connection file

// Get form data
$formID = $_POST['formID'];
$courseData = $_POST['courseData']; // JSON encoded course data

// Update the apply table with the new course information
$query = "UPDATE apply SET Course_Details = '$courseData', Form_status = 'Incomplete' WHERE FormID = '$formID'";
if (mysqli_query($conn, $query)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
