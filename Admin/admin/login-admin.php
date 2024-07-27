<?php
session_start();
$error = "";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    // Directly specify your MySQL connection details
    $servername = "localhost";
    $username = "root";
    $db_password = ""; // renamed to db_password to avoid conflict with $password variable
    $dbname = "LINMS";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch admin details
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM Login_admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['username']; // corrected to 'username'
            if ($remember) {
                setcookie('admin_id', $admin['id'], time() + (86400 * 30), "/");
            }
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password."; // Changed error message for incorrect password
        }
    } else {
        $error = "Email not found."; // Changed error message for email not found
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding-top: 100px;
        }
        .login-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-form .form-control {
            border-radius: 20px;
        }
        .login-form .btn-primary {
            border-radius: 20px;
        }
        .loading-spinner {
            display: none;
            width: 24px;
            height: 24px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top-color: #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-form">
        <h2 class="text-center"><i class="fas fa-user"></i> Admin Login</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="" id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                Login
                <div class="loading-spinner" id="loadingSpinner"></div>
            </button>
            <a href="forgot-password.php" class="d-block text-center mt-2">Forgot Password?</a>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function() {
            $('#loadingSpinner').show();
        });

        $('input').on('blur', function() {
            const value = $(this).val();
            if (/[^a-zA-Z0-9@._-]/.test(value)) {
                alert('Unacceptable characters detected. Please use only letters, numbers, and @ . _ -');
                $(this).val('');
            }
        });
    });
</script>
</body>
</html>
