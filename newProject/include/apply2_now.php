<?php
// Connect to the database
include('db_connection.php'); // Ensure you have a database connection

// Assuming you have a session variable for the user's full name and sex
session_start();
$full_name = $_SESSION['full_name'];
$sex = $_SESSION['sex'];

// Check for a running intake
$sql = "SELECT * FROM intakes WHERE intake_status = 'Running'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // There is a running intake
    echo '
    <div class="alert alert-info mt-3">
        <h3>Dear: <strong>' . $full_name . '</strong></h3>
        <p>Please fill in your form with Correct Information. All fields marked <span style="color:red">*</span> are <strong>MANDATORY</strong>. Falsification of Information/Documents is <strong>PROHIBITED</strong>! This, if discovered, either prior to or after Admission, will lead to automatic disqualification.</p>
        <div class="d-flex justify-content-between align-items-center mb-3"></div>
    </div>
    <div class="alert alert-info mt-3">
        <strong>Please Note:</strong> You <strong><danger>MUST</danger></strong> fill all Form Sections appropriately before you submit your Application Form!
    </div>
    ';
    // Include your application form here
    include('application_form.php');
} else {
    // No running intake
    $salutation = $sex == 'M' ? 'Sir' : 'Madam';
    $next_year = date('Y') + 1;
    echo '
    <div class="alert alert-info mt-3">
        <span class="circle-exclamation">
            <i class="fas fa-exclamation"></i>
        </span>
        <strong>APPLY FOR CERTIFICATES AND DIPLOMA COURSES. O-LEVEL LEAVERS, A-LEVEL LEAVERS AND THOSE UPGRADING!</strong>
    </div>
    <div class="alert alert-info mt-3">
        <strong>Sorry ' . $salutation . '!</strong> There are currently no intakes at the moment. Please try again starting March ' . $next_year . '.
    </div>
    ';
}
?>
