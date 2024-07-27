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

// Retrieve POST data
$schoolUCE = $_POST['schoolName'];
    $indexNumberUCE = $_POST['indexNumberUCE'];
    $yearUCE = $_POST['yearOfSitting'];
    $subjectsUCE = isset($_POST['subjects']) ? $_POST['subjects'] : '[]';
    $aggregate = $_POST['aggregate'];
    $division = $_POST['division'];
    $distinctions = $_POST['distinctions'] ?? null;
    $credits = $_POST['credits'] ?? null;
    $passes = $_POST['passes'] ?? null;
    $failures = $_POST['failures'] ?? null;
// Retrieve formID and applicantNumber from POST
$formID = $_POST['formID'];
$applicantNumber = $_POST['applicantNumber'];

// Create an associative array for JSON data
$data = json_encode([
    'schoolUCE' => $schoolUCE,
    'indexNumberUCE' => $indexNumberUCE,
    'yearUCE' => $yearUCE,
    'subjectsUCE' => json_decode($subjectsUCE, true),
    'summary' => [
        'aggregate' => $aggregate,
        'division' => $division,
        'distinctions' => $distinctions,
        'credits' => $credits,
        'passes' => $passes,
        'failures' => $failures,
    ]
]);

// Convert array to JSON
$dataJSON = json_encode($data);

// Prepare the SQL query
$sql = "UPDATE applications SET 
        olevel_data = ? 
        WHERE formID = ? AND applicantNumber = ?";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $dataJSON, $formID, $applicantNumber);

// Execute the query
if ($stmt->execute()) {
    echo "Data updated successfully!";
} else {
    echo "Error updating data: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
