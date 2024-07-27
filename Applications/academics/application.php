<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 // Include your database connection

 $formID = $_GET['formID'] ?? null;
 $applicantNumber = $_GET['applicantNumber'] ?? null;
 
 if ($formID && $applicantNumber) {
     // Fetch user data from the database
     $query = "SELECT entryType, level FROM applications WHERE formID = ? AND applicantNumber = ?";
     $stmt = $conn->prepare($query);
     $stmt->bind_param("ss", $formID, $applicantNumber);
     $stmt->execute();
     $stmt->bind_result($entryType, $level);
     $stmt->fetch();
     $stmt->close();
 } else {
     // Handle missing parameters
     die('Missing formID or applicantNumber.');
 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Information</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .nav-item { display: none; } /* Hide all tabs by default */
    </style>
</head>
<body>
<div class="container">
    <h2>Academic Information</h2>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" id="olevel-tab">
            <a class="nav-link" data-toggle="tab" href="#olevel">O Level</a>
        </li>
        <li class="nav-item" id="alevel-tab">
            <a class="nav-link" data-toggle="tab" href="#alevel">A Level</a>
        </li>
        <li class="nav-item" id="other-qualifications-tab">
            <a class="nav-link" data-toggle="tab" href="#other-qualifications">Other Qualifications</a>
        </li>
        <li class="nav-item" id="submit-tab">
            <a class="nav-link" data-toggle="tab" href="#review-submit">Submit Application</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="olevel" class="container tab-pane fade"><br>
            <!-- O Level Form -->
            <?php include 'olevel-form.php'; ?>
        </div>
        <div id="alevel" class="container tab-pane fade"><br>
            <!-- A Level Form -->
            <?php include 'alevel-form.php'; ?>
        </div>
        <div id="other-qualifications" class="container tab-pane fade"><br>
            <!-- Other Qualifications Form -->
            <?php include 'other-qualifications-form.php'; ?>
        </div>
        <div id="review-submit" class="container tab-pane fade"><br>
            <!-- Review & Submit Form -->
            <?php include 'review-submit-form.php'; ?>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var entryType = '<?php echo $entryType; ?>';
        var level = '<?php echo $level; ?>';

        function showTab(tabId) {
            document.getElementById(tabId).style.display = 'block';
        }

        function hideTab(tabId) {
            document.getElementById(tabId).style.display = 'none';
        }

        if (entryType === 'direct') {
            if (level === 'certificate') {
                showTab('olevel-tab');
                showTab('submit-tab');
                hideTab('alevel-tab');
                hideTab('other-qualifications-tab');
            } else if (level === 'diploma') {
                showTab('olevel-tab');
                showTab('alevel-tab');
                showTab('submit-tab');
                hideTab('other-qualifications-tab');
            }
        } else if (entryType === 'indirect') {
            if (level === 'diploma') {
                showTab('olevel-tab');
                showTab('alevel-tab');
                showTab('other-qualifications-tab');
                showTab('submit-tab');
            }
        }

        // Initialize autocomplete and other scripts here
    });
</script>
</body>
</html>
