<?php
session_start();

// Adjust the relative path to db_connection.php based on the directory structure
include __DIR__ . '/../db_connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    if ($newPassword !== $confirmNewPassword) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: forgot_password.php');
        exit();
    } else {
        if (strlen($newPassword) < 6) {
            $_SESSION['error'] = 'Password must be at least 6 characters long.';
            header('Location: forgot_password.php');
            exit();
        }

        // Sanitize and hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $applicant_id = $_SESSION['reset_applicant_id'];
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE applicantNumber = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("ss", $hashedPassword, $applicant_id);
        
        if ($stmt->execute() === false) {
            die("Execute failed: " . $stmt->error);
        }
        
        $stmt->close();

        // Redirect to login page after successful password reset
        header('Location: ../index.php');
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password-Lubega Institute</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">Set New Password</h3>
                <div id="message" class="alert alert-danger d-none"></div>
                <form id="passwordForm" method="POST">
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" required minlength="6">
                        <small class="form-text text-muted">Password must be at least 6 characters long.</small>
                    </div>
                    <div class="form-group">
                        <label for="confirmNewPassword">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Repeat new password" required minlength="6">
                        <small class="form-text text-muted">Passwords must match.</small>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Set Password</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('passwordForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var newPassword = document.getElementById('newPassword').value;
            var confirmNewPassword = document.getElementById('confirmNewPassword').value;
            var messageDiv = document.getElementById('message');

            if (newPassword !== confirmNewPassword) {
                messageDiv.textContent = 'Passwords do not match.';
                messageDiv.classList.remove('d-none');
            } else {
                messageDiv.classList.add('d-none');
                this.submit();  // Proceed with form submission if validation is successful
            }
        });
    </script>
</body>
</html>
