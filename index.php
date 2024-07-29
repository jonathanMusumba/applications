<?php
// Include the configuration
include 'db_connection/db_connection.php';


session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

// Handle message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageForm'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message, status) VALUES (?, ?, ?, 'Unread')");
        $stmt->execute([$name, $email, $message]);

        $_SESSION['message_status'] = 'Your message has been sent successfully.';
    } else {
        $_SESSION['message_status'] = 'Please fill in all the fields.';
    }

    header('Location: index.php');
    exit();
}

$message_status = isset($_SESSION['message_status']) ? $_SESSION['message_status'] : '';
unset($_SESSION['message_status']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lubega Institute Online Application Portal</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        background-color: #f5f5f5;
            overflow-x: hidden;
        }

        .preloader {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: fixed;
            width: 100%;
            background-color: #f5f5f5;
            z-index: 1000;
        }

        .progress-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-left: 16px solid transparent;
            border-bottom: 16px solid transparent;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
            width: 100%;
            height: auto;
        }

        .login-container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .btn-group-vertical {
            width: 100%;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .contact-info button {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            padding: 10px;
            border-radius: 5px;
        }

        .modal-dialog {
            max-width: 500px;
        }

        @media (max-width: 767px) {
            .btn-group-vertical .btn {
                margin-bottom: 10px;
            }
        }
       
    </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="progress-circle"></div>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <!-- Logo and Institute Information -->
        <div class="logo-container text-center">
            <img src="images/logo.webp" alt="Lubega Institute Logo" class="logo mb-3">
            <h3 class="font-weight-bold text-success">LUBEGA INSTITUTE</h3>
            <h5 class="text-success">ONLINE APPLICATION PORTAL</h5>
        </div>
        <div class="toast-container position-fixed bottom-0 right-0 p-3">
        <?php
        

        // Check if there's a logout message to display
        if (isset($_SESSION['logout_message'])): ?>
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto">Notification</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    <?php echo htmlspecialchars($_SESSION['logout_message']); ?>
                </div>
            </div>
            <?php
            // Unset the session variable after showing the toast
            unset($_SESSION['logout_message']);
        endif;
        ?>
    </div>
        <!-- Login Section -->
        <div class="login-container">
            <h4 class="text-center mb-4">LOGIN</h4>
            <form id="loginForm" method="post" action="applicants/login.php">
                <div class="form-group mb-3">
                    <label for="emailPhone">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input type="text" class="form-control" id="emailPhone" name="emailPhone" required>
                    <small class="form-text text-muted">Username is Case Sensitive</small>
                </div>

                <div class="form-group mb-3">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                                <label for="showPassword" class="mb-0 ml-2">Show</label>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> LOG IN
                    </button>
                </div>
            </form>
        </div>
        <div class="text-center mt-3">
         <p>Did you forget your password? <a href="forgot_password.php" class="btn btn-link">Click here to Reset</a></p>
        </div>
        <div class="text-center mb-4">
            <button type="button" class="btn btn-secondary" onclick="location.href='applicants/register.html'">
                <i class="fas fa-user-plus"></i> REGISTER NOW
            </button>
            <button type="button" class="btn btn-info" onclick="location.href='page404.html'">
                <i class="fas fa-question-circle"></i> HOW TO APPLY
            </button>
        </div>

        <!-- Contact Information -->
        

        <!-- YouTube Video -->
        <div class="text-center">
            <h5>Watch our tutorial on how to register:</h5>
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/your_video_id" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Simulate a loading process
            setTimeout(function() {
                document.querySelector(".preloader").style.display = "none";
                document.querySelector(".container").style.display = "block";
            }, 3000); // Adjust the timeout as needed

            window.togglePasswordVisibility = function() {
                var passwordField = document.getElementById("password");
                var showPasswordCheckbox = document.getElementById("showPassword");
                if (showPasswordCheckbox.checked) {
                    passwordField.type = "text";
                } else {
                    passwordField.type = "password";
                }
            };
        });

        function callNumber(number) {
            window.location.href = `tel:${number}`;
        }

        function openWhatsAppChat(number) {
            window.location.href = `https://wa.me/${number}`;
        }
        $(document).ready(function() {
            // Show the toast if there is a message
            $('.toast').toast('show');
        });
       
        
    </script>
</body>
</html>
