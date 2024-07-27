<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if user not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login-admin.php");
    exit();
}
// Set session timeout to 30 minutes
$timeout_duration = 1800;

// Check if last activity is set
if (isset($_SESSION['last_activity'])) {
    // Calculate session expiry time
    $session_expiry = $_SESSION['last_activity'] + $timeout_duration;

    // Check if session has expired
    if (time() > $session_expiry) {
        session_unset();    // Unset all session variables
        session_destroy();  // Destroy the session
        $_SESSION['message'] = "Session Expired. Please Login Again!";
        header("Location: login-admin.php");
        exit();
    }
}

// Update last activity time
$_SESSION['last_activity'] = time();

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

$admin = array();
$email = '';
// Fetch admin details
if (isset($_SESSION['admin_id'])) {
    $userId = $_SESSION['admin_id'];
    $query = "SELECT username, email FROM login_admin WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $email = htmlspecialchars($admin['email']);
    }
}

// Fetch application statistics
$query_applications = "SELECT COUNT(*) as application_count FROM applications WHERE YEAR(createDate) = YEAR(CURDATE())";
$result_applications = $conn->query($query_applications);
$applicationCount = $result_applications->fetch_assoc()['application_count'];

$query_registered_users = "SELECT COUNT(*) as user_count FROM users";
$result_registered_users = $conn->query($query_registered_users);

// Check if query was successful
if ($result_registered_users) {
    $userCount = $result_registered_users->fetch_assoc()['user_count'];
} else {
    $userCount = 0; // default to 0 if query fails
}

$currentYear = date('Y');
$query_completed_applications = "SELECT COUNT(*) as completed_application_count FROM applications WHERE status = 'Completed' AND YEAR(createDate) = ?";
$stmt_completed_applications = $conn->prepare($query_completed_applications);
$stmt_completed_applications->bind_param("i", $currentYear);
$stmt_completed_applications->execute();
$completedApplicationCount = $stmt_completed_applications->get_result()->fetch_assoc()['completed_application_count'];

$currentYear = date('Y');
$query_pending_applications = "SELECT COUNT(*) as pending_application_count FROM applications WHERE status = 'Pending' AND YEAR(createDate) = ?";
$stmt_pending_applications = $conn->prepare($query_pending_applications);
$stmt_pending_applications->bind_param("i", $currentYear);
$stmt_pending_applications->execute();
$pendingApplicationCount = $stmt_pending_applications->get_result()->fetch_assoc()['pending_application_count'];


$query_direct_certificates = "SELECT COUNT(*) as direct_certificate_count FROM applications WHERE entryType = 'Direct' AND level = 'Certificate'";
$result_direct_certificates = $conn->query($query_direct_certificates);
$directCertificateCount = $result_direct_certificates->fetch_assoc()['direct_certificate_count'];

// Query to fetch direct diplomas count
$query_direct_diplomas = "SELECT COUNT(*) as direct_diploma_count FROM applications WHERE entryType = 'Direct' AND level = 'Diploma'";
$result_direct_diplomas = $conn->query($query_direct_diplomas);
$directDiplomaCount = $result_direct_diplomas->fetch_assoc()['direct_diploma_count'];

// Query to fetch indirect diplomas count
$query_indirect_diplomas = "SELECT COUNT(*) as indirect_diploma_count FROM applications WHERE entryType = 'Indirect'";
$result_indirect_diplomas = $conn->query($query_indirect_diplomas);
$indirectDiplomaCount = $result_indirect_diplomas->fetch_assoc()['indirect_diploma_count'];
$currentYear = date('Y');

// Query to fetch count of admitted applicants for current year
$query_admitted_count = "SELECT COUNT(*) as admitted_count FROM Admitted WHERE YEAR(AdmitDate) = $currentYear";
$result_admitted_count = $conn->query($query_admitted_count);
$admittedCount = $result_admitted_count->fetch_assoc()['admitted_count'];

$recentApplications = array(); // Initialize as an array or appropriate data type
$recentUsers = array(); // Initialize as an array or appropriate data type
$recentMessages = array();

$query_users_gender = "SELECT sex, COUNT(*) as count FROM users GROUP BY sex";
$result_users_gender = $conn->query($query_users_gender);
$usersGenderData = [];
while ($row = $result_users_gender->fetch_assoc()) {
    $usersGenderData[$row['sex']] = $row['count'];
}

// Example to fetch applications status data
$query_applications_status = "SELECT status, COUNT(*) as count FROM applications GROUP BY status";
$result_applications_status = $conn->query($query_applications_status);
$applicationsStatusData = [];
while ($row = $result_applications_status->fetch_assoc()) {
    $applicationsStatusData[$row['status']] = $row['count'];
}
// Close database connection
$conn->close();

// Display fetched data or process further as needed
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="main-css/admin-styles.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    
    <!-- Toggle Button for Sidebar (using Font Awesome icon) -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar items aligned to the right -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    
                     echo 'Logged in as ' . htmlspecialchars($admin['username']); ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <!-- Profile Modal Trigger -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">My Profile</a>
                    <!-- Change Password Modal Trigger -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a>
                    <!-- Logout Form -->
                    <form action="logout.php" method="post">
                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>


<div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar">
        <!-- Dashboard Section -->
        <a href="#" id="sidebarDashboard">
            <i class="fas fa-tachometer-alt" data-toggle="tooltip" title="Dashboard"></i> Dashboard
        </a>

        <!-- Users Section -->
        <a href="#" id="sidebarUsers" data-toggle="collapse" data-target="#usersSubMenu" aria-expanded="true" aria-controls="usersSubMenu">
            <i class="fas fa-users" data-toggle="tooltip" title="Users"></i> Users
        </a>
        <!-- Users Submenu -->
        <div id="usersSubMenu" class="collapse">
            <a href="#" id="sidebarRegisteredUsers">
                <i class="fas fa-user" data-toggle="tooltip" title="Registered Users"></i> Registered Users
            </a>
            <a href="#" id="sidebarManageUsers">
                <i class="fas fa-cogs" data-toggle="tooltip" title="Manage Users"></i> Manage Users
            </a>
        </div>

        <!-- Applications Section -->
        <a href="#" id="sidebarApplications" data-toggle="collapse" data-target="#applicationsSubMenu" aria-expanded="true" aria-controls="applicationsSubMenu">
            <i class="fas fa-file-alt" data-toggle="tooltip" title="Applications"></i> Applications
        </a>
        <!-- Applications Submenu -->
        <div id="applicationsSubMenu" class="collapse">
            <a href="#" id="sidebarReceivedApplications">
                <i class="fas fa-inbox" data-toggle="tooltip" title="Received Applications"></i> Received Applications
            </a>
            <a href="#" id="sidebarManageApplications">
                <i class="fas fa-cogs" data-toggle="tooltip" title="Manage Applications"></i> Manage Applications
            </a>
            <a href="#" id="sidebarAdmittedApplicants">
                <i class="fas fa-user-check" data-toggle="tooltip" title="Admitted Applicants"></i> Admitted Applicants
            </a>
            <a href="#" id="sidebarPendingApplicants">
                <i class="fas fa-user-clock" data-toggle="tooltip" title="Pending Applicants"></i> Pending Applicants
            </a>
        </div>

        <!-- Messages Section -->
        <a href="#" id="sidebarMessages" data-toggle="collapse" data-target="#messagesSubMenu" aria-expanded="true" aria-controls="messagesSubMenu">
            <i class="fas fa-envelope" data-toggle="tooltip" title="Messages"></i> Messages
        </a>
        <!-- Messages Submenu -->
        <div id="messagesSubMenu" class="collapse">
            <a href="#" id="sidebarReceivedMessages">
                <i class="fas fa-inbox" data-toggle="tooltip" title="Received Messages"></i> Received
            </a>
            <a href="#" id="sidebarSentMessages">
                <i class="fas fa-paper-plane" data-toggle="tooltip" title="Sent Messages"></i> Sent
            </a>
            <a href="#" id="sidebarSendNewMessage">
                <i class="fas fa-edit" data-toggle="tooltip" title="Send New Message"></i> Send New Message
            </a>
        </div>

        <!-- Add New Admin Section -->
        <a href="#" id="sidebarAddNewAdmin">
            <i class="fas fa-user-plus" data-toggle="tooltip" title="Add New Admin"></i> Add New Admin
        </a>

        <!-- Settings Section -->
        <a href="#" id="sidebarSettings" data-toggle="collapse" data-target="#settingsSubMenu" aria-expanded="true" aria-controls="settingsSubMenu">
            <i class="fas fa-cogs" data-toggle="tooltip" title="Settings"></i> Settings
        </a>
        <!-- Settings Submenu -->
        <div id="settingsSubMenu" class="collapse">
            <a href="#" id="sidebarSetNew">
                <i class="fas fa-plus" data-toggle="tooltip" title="Set New"></i> Set New
            </a>
            <a href="#" id="sidebarManageSettings">
                <i class="fas fa-wrench" data-toggle="tooltip" title="Manage Settings"></i> Manage Settings
            </a>
        </div>

        <!-- Admissions Section -->
        <a href="#" id="sidebarAdmissions" data-toggle="collapse" data-target="#admissionsSubMenu" aria-expanded="true" aria-controls="admissionsSubMenu">
            <i class="fas fa-graduation-cap" data-toggle="tooltip" title="Admissions"></i> Admissions
        </a>
        <!-- Admissions Submenu -->
        <div id="admissionsSubMenu" class="collapse">
            <a href="#" id="sidebarAdmitStudent">
                <i class="fas fa-user-plus" data-toggle="tooltip" title="Admit Student"></i> Admit Student
            </a>
            <a href="#" id="sidebarManageAdmissions">
                <i class="fas fa-cogs" data-toggle="tooltip" title="Manage Admissions"></i> Manage Admissions
            </a>
        </div>

        <!-- Intakes Section -->
        <a href="#" id="sidebarIntakes" data-toggle="collapse" data-target="#intakesSubMenu" aria-expanded="true" aria-controls="intakesSubMenu">
            <i class="fas fa-users" data-toggle="tooltip" title="Intakes"></i> Intakes
        </a>
        <!-- Intakes Submenu -->
        <div id="intakesSubMenu" class="collapse">
            <a href="#" id="sidebarCreateIntake">
                <i class="fas fa-plus" data-toggle="tooltip" title="Create Intake"></i> Create Intake
            </a>
            <a href="#" id="sidebarManageIntakes">
                <i class="fas fa-cogs" data-toggle="tooltip" title="Manage Intakes"></i> Manage Intakes
            </a>
        </div>
        <div id="logoutSubMenu">
            <a href="#" id="sidebarLogout">
                <i class="fas fa-sign-out-alt" data-toggle="tooltip" title="Logout"></i> Logout
            </a>
        </div>


    </div>

    <div class="col-md-10 main-content">
    <div class="container mt-4">
        <div class="dashboard-overview">
            <div class="row">
                <!-- Registered Users -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Registered Users</h5>
                            <p class="card-text"><?php echo $userCount; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Applications -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Applications</h5>
                            <p class="card-text"><?php echo $applicationCount; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Completed Applications -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Completed</h5>
                            <p class="card-text"><?php echo $completedApplicationCount; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Pending Applications -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Pending</h5>
                            <p class="card-text"><?php echo $pendingApplicationCount; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Direct Entry (Certificates) -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Certificate-Direct</h5>
                            <p class="card-text"><?php echo $directCertificateCount; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Direct Entry (Diplomas) -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Diploma-Direct</h5>
                            <p class="card-text"><?php echo $directDiplomaCount; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Indirect Entry (Diplomas) -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Diploma-Indirect</h5>
                            <p class="card-text"><?php echo $indirectDiplomaCount; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Admitted -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Admitted</h5>
                            <p class="card-text"><?php echo $admittedCount; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <!-- Recent Applications -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Recent Applications</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Entry Type</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentApplications as $application): ?>
                                        <tr>
                                            <td><?php echo $application['surname'] . ' ' . $application['other_names']; ?></td>
                                            <td><?php echo $application['entry_type']; ?></td>
                                            <td><?php echo $application['course']; ?></td>
                                            <td><?php echo $application['status']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Registered Users -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Recent Registered Users</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Applicant Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentUsers as $user): ?>
                                        <tr>
                                            <td><?php echo $user['surname'] . ' ' . $user['other_names']; ?></td>
                                            <td><?php echo $user['sex']; ?></td>
                                            <td><?php echo $user['applicant_number']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <!-- Recent Activity -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activity</h5>
                            <ul class="list-group list-group-flush">
                                <?php
                                $activities = [];

                                // Add recent users registrations
                                foreach ($recentUsers as $user) {
                                    $activities[] = [
                                        'message' => $user['surname'] . ' ' . $user['other_names'] . ' has registered.',
                                        'timestamp' => strtotime($user['registration_date'])
                                    ];
                                }

                                // Add recent completed applications
                                foreach ($recentApplications as $application) {
                                    $activities[] = [
                                        'message' => $application['surname'] . ' ' . $application['other_names'] . ' has completed his/her application.',
                                        'timestamp' => strtotime($application['completion_date'])
                                    ];
                                }

                                // Add recent messages
                                foreach ($recentMessages as $message) {
                                    $activities[] = [
                                        'message' => $message['sender_name'] . ' has messaged you: "' . $message['content'] . '".',
                                        'timestamp' => strtotime($message['timestamp'])
                                    ];
                                }

                                // Sort activities by timestamp in descending order
                                usort($activities, function($a, $b) {
                                    return $b['timestamp'] - $a['timestamp'];
                                });

                                $count = 0;
                                foreach ($activities as $activity) {
                                    if ($count >= 10) {
                                        break;
                                    }
                                    echo '<li class="list-group-item">' . htmlspecialchars($activity['message']) . '</li>';
                                    $count++;
                                }

                                if (empty($activities)) {
                                    echo '<li class="list-group-item">No Activity</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Charts</h5>
                            <canvas id="usersGenderChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Applications Overview</h5>
                            <canvas id="applicationsOverviewChart"></canvas>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Traffic Overview</h5>
                            <canvas id="trafficOverviewChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div
    </div>

            

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">My Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Profile form or content goes here -->
                <p>This is a placeholder for My Profile modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Example of Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Change password form or content goes here -->
                <p>This is a placeholder for Change Password modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Example of Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="logout.php" method="post">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

                </div>
            </div>
        <?php include('modals/registered_users.php'); ?>
        <?php include('modals/received_applications.php'); ?>
        <?php include('modals/manage_applications.php'); ?>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/admin-scripts.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  $(document).ready(function() {
    console.log('Document ready!'); // Check if this message appears in the browser console
    $('#sidebarManageApplications').on('click', function(e) {
        e.preventDefault();
        console.log('Manage Applications link clicked!'); // Check if this message appears in the browser console
        $('.main-content').load('sidebar/manage_applications.php');
    });
});
            // Dynamic content loading for sidebar items
           
    // Initialize tooltips
         $('[data-toggle="tooltip"]').tooltip();

            // Top navigation actions
            $('#dropdownProfile').on('click', function(e) {
                e.preventDefault();
                $('.main-content').load('profile.php');
            });

            $('#dropdownChangePassword').on('click', function(e) {
                e.preventDefault();
                $('.main-content').load('change_password.php');
            });

            $('#dropdownLogout').on('click', function(e) {
                e.preventDefault();
                window.location.href = 'logout.php';
            });

            // Chart.js setup
            var ctx = document.getElementById('applicationsChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Registered Users', 'Applications', 'Total Applications', 'Direct Entry (Certificates)', 'Direct Entry (Diplomas)', 'Indirect Entry (Diplomas)'],
                    datasets: [{
                        label: 'Count',
                        data: [
                            <?php echo $userCount; ?>,
                            <?php echo $applicationCount; ?>,
                            <?php echo $totalApplicationCount; ?>,
                            <?php echo $directCertificateCount; ?>,
                            <?php echo $directDiplomaCount; ?>,
                            <?php echo $indirectDiplomaCount; ?>
                        ],
                        backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545', '#007bff', '#6c757d']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

        var ctxUsersGender = document.getElementById('usersGenderChart').getContext('2d');
    var usersGenderChart = new Chart(ctxUsersGender, {
        type: 'pie',
        data: {
            labels: ['Male (M)', 'Female (F)'],
            datasets: [{
                label: 'Users Gender',
                data: [<?php echo isset($usersGenderData['M']) ? $usersGenderData['M'] : 0; ?>, <?php echo isset($usersGenderData['F']) ? $usersGenderData['F'] : 0; ?>],
                backgroundColor: ['#007bff', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });

    // Applications Status Chart
    var ctxApplicationsStatus = document.getElementById('applicationsStatusChart').getContext('2d');
    var applicationsStatusChart = new Chart(ctxApplicationsStatus, {
        type: 'pie',
        data: {
            labels: ['Submitted', 'Pending'],
            datasets: [{
                label: 'Applications Status',
                data: [<?php echo isset($applicationsStatusData['Submitted']) ? $applicationsStatusData['Submitted'] : 0; ?>, <?php echo isset($applicationsStatusData['Pending']) ? $applicationsStatusData['Pending'] : 0; ?>],
                backgroundColor: ['#28a745', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });
   
    </script>
</body>

</html>
