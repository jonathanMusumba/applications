<?php
session_start();

// Adjust the relative path to db_connection.php based on the directory structure
$include_path = __DIR__ . '/../../db_connection/db_connection.php';

if (file_exists($include_path)) {
    include $include_path;
    // Now you can use $conn
} else {
    echo "Error: db_connection.php file not found.";
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $oldPassword = htmlspecialchars(trim($_POST['oldPassword']));
    $newPassword = htmlspecialchars(trim($_POST['newPassword']));
    $confirmNewPassword = htmlspecialchars(trim($_POST['confirmNewPassword']));

    // Validate input fields
    if (empty($oldPassword) || empty($newPassword) || empty($confirmNewPassword)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: set_newpassword.php");
        exit();
    }

    // Retrieve user's current password hash from users table
    $userId = $_SESSION['user_id'];
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify old password
        if (password_verify($oldPassword, $hashedPassword)) {
            // Check if new password matches confirm new password
            if ($newPassword !== $confirmNewPassword) {
                $_SESSION['error'] = "New passwords do not match.";
                header("Location: set_newpassword.php");
                exit();
            }

            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password in the users table
            $updateQuery = "UPDATE users SET password = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('si', $hashedNewPassword, $userId);
            $updateStmt->execute();

            $_SESSION['success'] = "Password updated successfully.";
            header("Location: set_newpassword.php");
            exit();
        } else {
            $_SESSION['error'] = "Old password is incorrect.";
            header("Location: set_newpassword.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found.";
        header("Location: set_newpassword.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            margin-top: 20px;
            padding: 20px;
        }
        .form-group.required label:after {
            color: red;
            content: "*";
            margin-left: 5px;
        }
        .fas.fa-lock {
            font-size: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4"><i class="fas fa-lock"></i> Change Your Password</h3>
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>
                        <form id="changePasswordForm" method="POST" action="set_newpassword.php">
                            <div class="form-group required">
                                <label for="oldPassword">Old Password</label>
                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                            </div>
                            <div class="form-group required">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                            <div class="form-group required">
                                <label for="confirmNewPassword">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
