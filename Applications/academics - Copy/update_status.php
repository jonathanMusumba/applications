<?php
session_start();
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

// SQL query to update oLevelCompleted based on Olevel_information being not NULL
$sql = "UPDATE applications 
        SET oLevelCompleted = TRUE 
        WHERE Olevel_information IS NOT NULL AND Olevel_information <> ''";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Records updated successfully.";
} else {
    echo "Error updating records: " . $conn->error;
}

// Close the connection
$conn->close();
?>
