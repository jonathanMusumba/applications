<?php
include 'db.php';

$sql = "SELECT * FROM courses ORDER BY course_name ASC";
$result = $conn->query($sql);

$courses = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

echo json_encode($courses);
$conn->close();
?>
