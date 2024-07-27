<?php
session_start();
include __DIR__ . '/../db_connection/db_connection.php';

// Check if formID is submitted
if (isset($_POST['formID']) && !empty($_POST['formID'])) {
    $formID = $_POST['formID'];

    // Check if applicantNumber is in session
    if (!isset($_SESSION['applicantNumber'])) {
        header("Location: dashboard.php?error=missing_applicant_number_in_session");
        exit();
    }

    $applicantNumber = $_SESSION['applicantNumber'];

    // SQL query to check if formID exists for the logged-in user
    $query = "SELECT entryType, level FROM applications WHERE FormID = ? AND applicantNumber = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $formID, $applicantNumber);
    $stmt->execute();
    $stmt->bind_result($entryType, $level);
    $stmt->fetch();
    
    if ($entryType && $level) {
        // Form ID exists for the logged-in user and data retrieved
        // Redirect to Academics Form with formID, applicantNumber, entryType, and level
        header("Location: academics/academics.php?formID=$formID&applicantNumber=$applicantNumber&entryType=$entryType&level=$level");
        exit();
    } else {
        // Form ID does not exist or does not belong to the logged-in user
        header("Location: dashboard.php?error=invalid_form_id");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Form ID not submitted
    header("Location: dashboard.php?error=missing_form_id");
    exit();
}
?>
