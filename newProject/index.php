<?php
session_start(); // Initialize session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    // Redirect to login page
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .tab-content {
            padding: 20px;
        }
        .form-label {
            margin-bottom: 0;
        }
        .form-control {
            margin-bottom: 0;
        }
        .form-control[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="applicationTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="biodata-tab" data-toggle="tab" href="#biodata" role="tab">Biodata</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="permanent-address-tab" data-toggle="tab" href="#permanent-address" role="tab">Permanent Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="next-of-kin-tab" data-toggle="tab" href="#next-of-kin" role="tab">Next of Kin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="course-information-tab" data-toggle="tab" href="#course-information" role="tab">Course Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="submit-tab" data-toggle="tab" href="#submit" role="tab">Submit</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                <?php include 'php/biodata.php'; ?>
            </div>
            <div class="tab-pane fade" id="permanent-address" role="tabpanel" aria-labelledby="permanent-address-tab">
                <?php include 'php/permanent_address.php'; ?>
            </div>
            <div class="tab-pane fade" id="next-of-kin" role="tabpanel" aria-labelledby="next-of-kin-tab">
                <?php include 'php/next_of_kin.php'; ?>
            </div>
            <div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="course-tab">
                <?php include 'php/course_information.php'; ?>
            </div>
            <div class="tab-pane fade" id="olevel" role="tabpanel" aria-labelledby="olevel-tab">
                <?php include 'php/olevel.php'; ?>
            </div>
            <div class="tab-pane fade" id="alevel" role="tabpanel" aria-labelledby="alevel-tab">
                <?php include 'php/alevel.php'; ?>
            </div>
            <div class="tab-pane fade" id="other-qualifications" role="tabpanel" aria-labelledby="other-qualifications-tab">
                <?php include 'php/other_qualifications'; ?>
            </div>
            <div class="tab-pane fade" id="submit" role="tabpanel" aria-labelledby="submit-tab">
                <?php include 'php/submit_form.php'; ?>
            </div>
        </div>
    </div>
    <script src="applications.js"></script>
</body>
</html>
