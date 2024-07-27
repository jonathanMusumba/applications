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
