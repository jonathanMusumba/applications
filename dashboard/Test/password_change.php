<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .toast-container {
            position: fixed;
            top: 0;
            right: 0;
            z-index: 1050;
        }
        .toast {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Change Password</h2>
        <form id="changePasswordForm" method="post">
            <div class="form-group">
                <label for="oldPassword">Old Password</label>
                <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                <small id="passwordHelp" class="form-text text-muted">
                    Password must be 6 characters or more. Include uppercase, lowercase, numbers, and special characters for better security.
                </small>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>

    <!-- Toast container -->
    <div class="toast-container">
        <div id="toast" class="toast" style="display: none;">
            <div class="toast-header">
                <strong class="mr-auto">Success</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                Password has been changed successfully.
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#changePasswordForm').on('submit', function (e) {
                e.preventDefault();
                
                var oldPassword = $('#oldPassword').val();
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();

                if (newPassword !== confirmPassword) {
                    alert('New password and confirm password do not match.');
                    return;
                }

                // Perform AJAX request to change password
                $.ajax({
                    url: 'change_password.php',
                    method: 'POST',
                    data: {
                        oldPassword: oldPassword,
                        newPassword: newPassword
                    },
                    success: function (response) {
                        // Handle success response
                        $('#toast').toast({ delay: 3000 }).toast('show');
                    },
                    error: function () {
                        // Handle error response
                        alert('Failed to change password. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
