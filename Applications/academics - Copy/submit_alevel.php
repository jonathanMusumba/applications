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


// Check if didNotSit is set
$didNotSit = isset($_POST['didNotSit']) ? $_POST['didNotSit'] : false;

// Handle data
if ($didNotSit) {
    $sql = "INSERT INTO Alevel_information (alevel_information) VALUES ('{}')";
} else {
    $alevelInformation = $_POST['alevel_information'];
    $sql = "INSERT INTO Alevel_information (alevel_information) VALUES (?)";
}

// Prepare and bind
$stmt = $conn->prepare($sql);
if (!$didNotSit) {
    $stmt->bind_param("s", $alevelInformation);
}

// Execute and check
if ($stmt->execute()) {
    echo "Results saved successfully.";
} else {
    echo "Error saving results: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
