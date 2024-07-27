<?php
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

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDB) === FALSE) {
    die("Error creating database: " . $conn->error);
}


$currentYear = date('Y');
$sql = "SELECT COUNT(*) as count FROM users WHERE YEAR(creation_date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $currentYear);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
echo json_encode(['count' => $row['count']]);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LUBEGA INSTITUTE</title>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <!-- Include DataTables Buttons CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <!-- Include moment.js for date handling -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include DataTables Date Range Search Plugin -->
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/date-range/datetime-moment.js"></script>
    <!-- Include DataTables Date Range Search CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.11.5/date-range/datetime-moment.css">
    <style>
        /* Add custom CSS styles here */
        
        #search_input,
        #academic_year {
            margin-bottom: 10px;
        }
        
        .search-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .nav-item {
            cursor: pointer;
        }
        
        .sub-nav {
            display: none;
        }
        
        .nav-item.active .sub-nav {
            display: block;
        }
        
        .nav-item .sub-nav {
            padding-left: 20px;
        }
        
        @media (max-width: 768px) {
            .nav-item .sub-nav {
                display: none;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            // Show children when parent item is clicked
            $('.nav-item').click(function() {
                $('.nav-item').removeClass('active');
                $(this).addClass('active');
            });

            // Fetch total registered users
            fetchTotalRegisteredUsers();
        });

        function fetchTotalRegisteredUsers() {
            $.ajax({
                url: 'fetch_total_registered_users.php',
                type: 'GET',
                success: function(response) {
                    $('#totalRegisteredUsers').text('Total Registered Users: ' + response.count);
                },
                error: function() {
                    $('#totalRegisteredUsers').text('Failed to fetch total registered users.');
                }
            });
        }
    </script>
</head>

<body>
    <!-- Include Header File -->
    <?php include 'header.php'; ?>

    <!-- Side Navigation -->
    <div class="container-fluid">
        <ul class="nav flex-column">
            <li class="nav-item" id="dashboard">
                <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item" id="applicants">
                <a class="nav-link" href="#">Applicants</a>
                <ul class="sub-nav">
                    <li><a href="#">Sub View Applicants</a></li>
                    <li><a href="#">Manage Applicants</a></li>
                </ul>
            </li>
            <li class="nav-item" id="users">
                <a class="nav-link" href="#">Users</a>
                <ul class="sub-nav">
                    <li><a href="#">Add User</a></li>
                    <li><a href="#">Manage Users</a></li>
                </ul>
            </li>
            <li class="nav-item" id="admissions">
                <a class="nav-link" href="#">Admissions</a>
                <ul class="sub-nav">
                    <li><a href="#">Admit Student</a></li>
                    <li><a href="#">View Admissions</a></li>
                </ul>
            </li>
            <li class="nav-item" id="courses">
                <a class="nav-link" href="#">Courses</a>
                <ul class="sub-nav">
                    <li><a href="#">View Courses</a></li>
                    <li><a href="#">Add Course</a></li>
                    <li><a href="#">Edit Course</a></li>
                </ul>
            </li>
            <li class="nav-item" id="logout">
                <a class="nav-link" href="#">Logout</a>
            </li>
        </ul>
    </div>

    <!-- Main Dashboard Content -->
    <div class="container-fluid mt-3">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Applicants per Level</h5>
                        <ul>
                            <li>Certificate</li>
                            <li>Diploma</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Applicants Today</h5>
                        <ul>
                            <li>Certificate</li>
                            <li>Diploma</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Applicants This Week</h5>
                        <ul>
                            <li>Certificate</li>
                            <li>Diploma</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Traffic</h5>
                        <!-- Include traffic tracking here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" id="totalRegisteredUsers">Loading...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer File -->
    <?php include 'footer.php'; ?>
</body>

</html>
