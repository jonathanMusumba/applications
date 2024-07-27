<?php
// Assuming connection to the database is already established
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_SESSION['FormID'])) {
    $formID = $_SESSION['FormID'];// Assuming formID is stored in session

        $sql = "SELECT 
        salutation, surname, otherNames, sex, entryType, level, academicSession, course, 
        schoolUCE, indexNumberUCE, yearUCE, schoolUACE, indexNumberUACE, yearUACE, 
        institutionName, awardObtained
        FROM applications 
        WHERE formID = ?";

        // Prepare and execute statement
        if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $formID);
        $stmt->execute();
        $stmt->bind_result(
        $salutation, $surname, $otherNames, $sex, $entryType, $level, $academicSession, $course, 
        $schoolUCE, $indexNumberUCE, $yearUCE, $schoolUACE, $indexNumberUACE, $yearUACE, 
        $institutionName, $awardObtained
        );

    if ($stmt->fetch()) {
        echo "<h3>Personal Information</h3>";
        echo "<p><strong>Salutation:</strong> $salutation</p>";
        echo "<p><strong>Full Name:</strong> $fullName</p>";
        echo "<p><strong>Sex:</strong> $sex</p>";
        echo "<p><strong>Entry Type:</strong> $entryType</p>";
        echo "<p><strong>Level:</strong> $level</p>";
        echo "<p><strong>Academic Session:</strong> $academicSession</p>";
        echo "<p><strong>Course:</strong> $course</p>";
        
        echo "<h3>O-Level Information</h3>";
        echo "<p><strong>School:</strong> $schoolUCE</p>";
        echo "<p><strong>Index Number:</strong> $indexNumberUCE</p>";
        echo "<p><strong>Year:</strong> $yearUCE</p>";
        
        if (!empty($schoolUACE)) {
            echo "<h3>A-Level Information</h3>";
            echo "<p><strong>School:</strong> $schoolUACE</p>";
            echo "<p><strong>Index Number:</strong> $indexNumberUACE</p>";
            echo "<p><strong>Year:</strong> $yearUACE</p>";
        }

        if (!empty($institutionName)) {
            echo "<h3>Other Qualifications</h3>";
            echo "<p><strong>Institution:</strong> $institutionName</p>";
            echo "<p><strong>Award:</strong> $awardObtained</p>";
        }
        
        echo "<h3>Declaration</h3>";
        echo "<p>I, <strong>$fullName</strong>, declare that to the best of my knowledge the information I have provided here is true and I agree to the online application terms and conditions of use.</p>";

    } else {
        echo "<p>No data found for the given form ID.</p>";
    }


    $stmt->close();
} else {
    echo "<p>Error preparing the statement.</p>";
}
}
?>
