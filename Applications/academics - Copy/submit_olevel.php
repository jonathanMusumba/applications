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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $schoolUCE = $_POST['schoolName'];
    $indexNumberUCE = $_POST['indexNumberUCE'];
    $yearUCE = $_POST['yearOfSitting'];
    $subjectsUCE = isset($_POST['subjects']) ? $_POST['subjects'] : '[]'; // Ensure this is correct
    $aggregate = $_POST['aggregate'];
    $division = $_POST['division'];
    $distinctions = $_POST['distinctions'] ?? '';
    $credits = $_POST['credits'] ?? '';
    $passes = $_POST['passes'] ?? '';
    $failures = $_POST['failures'] ?? '';
    $formID = $_POST['formID'];
    $applicantNumber = $_POST['applicantNumber'];
    

    // Create JSON object
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

    // Prepare the SQL query
    $sql = "UPDATE applications SET Olevel_information = ?, oLevelCompleted = TRUE WHERE formID = ? AND applicantNumber = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("sss", $data, $formID, $applicantNumber);

    if ($stmt->execute()) {
        header("Location: academics.php?formID=$formID&applicantNumber=$applicantNumber&status=success");
    } else {
        header("Location: academics.php?formID=$formID&applicantNumber=$applicantNumber&status=error");
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
