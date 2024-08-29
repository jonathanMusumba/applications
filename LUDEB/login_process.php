<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ludeb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute SQL statement
$stmt = $conn->prepare("SELECT id, username, password, role, status FROM system_users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $user, $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    // Check status
    if ($row['status'] == 'Invalid') {
        echo "Your account is invalid. Please contact support.";
        exit();
    }

    // Verify password
    if (password_verify($pass, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        
        // Update last login time
        $now = date('Y-m-d H:i:s');
        $updateStmt = $conn->prepare("UPDATE system_users SET last_login = ? WHERE id = ?");
        $updateStmt->bind_param("si", $now, $row['id']);
        $updateStmt->execute();
        $updateStmt->close();

        // Redirect based on role
        switch ($row['role']) {
            case 'System Admin':
                header("Location: Dashboard1.php");
                break;
            case 'Examination Administrator':
                header("Location: admin_dashboard.php");
                break;
            case 'Data Entrant':
                header("Location: home.php");
                break;
            default:
                header("Location: index.php");
                break;
        }
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username/email.";
}

$stmt->close();
$conn->close();
?>
