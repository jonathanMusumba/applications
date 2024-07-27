<?php
include 'db.php';

// SQL query to select all media records
$sql = "SELECT * FROM media ORDER BY date_uploaded DESC";
$result = $conn->query($sql);

$media = array();

// Check if there are results and fetch data
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $media[] = $row;
    }
}

// Return the result as JSON
echo json_encode($media);

// Close the database connection
$conn->close();
?>
