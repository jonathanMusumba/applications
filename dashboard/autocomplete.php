<?php
// autocomplete.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get the query parameter
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

// Prepare and execute the SQL statement
$sql = "SELECT CenterNo, Center_Name FROM sec_schools WHERE Center_Name LIKE '%$query%'";
$result = $conn->query($sql);

$suggestions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = [
            'CenterNo' => $row['CenterNo'],
            'Center_Name' => $row['Center_Name']
        ];
    }
}

// Close the connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($suggestions);
?>