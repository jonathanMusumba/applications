<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
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

    // Prepare data to insert into the 'uce' table
    $schoolName = $_POST['schoolName'] ?? '';
    $centerNumber = $_POST['centerNumber'] ?? '';
    $candidateNumber = $_POST['candidateNumber'] ?? '';
    $indexNumber = !empty($centerNumber) && !empty($candidateNumber) ? $centerNumber . '/' . $candidateNumber : NULL;
    $yearOfSitting = $_POST['yearOfSitting'] ?? '';
    $aggregate = $_POST['aggregate'] ?? '';
    $division = $_POST['division'] ?? '';

    // Convert summary data to JSON
    $summary = [
        'Distinctions' => $_POST['distinctions'] ?? '',
        'Credits' => $_POST['credits'] ?? '',
        'Passes' => $_POST['passes'] ?? '',
        'Failures' => $_POST['failures'] ?? ''
    ];
    $summaryJSON = json_encode($summary);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("JSON encoding error for summary data: " . json_last_error_msg());
    }

    $subjectsJSON = $_POST['subjects'] ?? NULL;
    $subjectsString = '';
    if ($subjectsJSON) {
        $subjectsData = json_decode($subjectsJSON, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("JSON decoding error for subjects data: " . json_last_error_msg());
        }

        // Format subjects data
        $subjects = [];
        foreach ($subjectsData as $subject) {
            $code = $subject['code'] ?? '';
            $grade = $subject['grade'] ?? '';
            if (!empty($code)) {
                $subjects[] = $code . '-' . $grade;
            }
        }
    if (empty($subjects)) {
        for ($i = 1; $i <= 8; $i++) {
            $subjects[] = [
                'subject' => "SUB$i",
                'grade' => ""
            ];
        }
    }
    $subjectsJSON = json_encode($subjects);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("JSON encoding error for subjects data: " . json_last_error_msg());
    }
    echo "<pre>";
    echo "School Name: $schoolName\n";
    echo "Index Number: $indexNumber\n";
    echo "Year of Sitting: $yearOfSitting\n";
    echo "Aggregate: $aggregate\n";
    echo "Division: $division\n";
    echo "Summary JSON: $summaryJSON\n";
    echo "Subjects JSON: $subjectsJSON\n";
    echo "</pre>";

    $indexNumber = trim($indexNumber, '/');
    // SQL query to insert data into the 'uce' table
    $sql = "INSERT INTO uce (schoolUCE, indexUCE, subjectsUCE, aggregatesUCE, divisionUCE, summaryUCE)
            VALUES ('$schoolName', '$indexNumber', '$subjectsJSON', '$aggregate', '$division', '$summaryJSON')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
}

?>
