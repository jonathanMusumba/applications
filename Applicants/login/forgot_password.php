<?php
session_start();
$include_path = __DIR__ . '/../../db_connection/db_connection.php';

if (file_exists($include_path)) {
    include $include_path;
    // Now you can use $conn
} else {
    echo "Error: db_connection.php file not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $emailPhone = htmlspecialchars(trim($_POST['emailPhone']));

    // Validate input fields
    if (empty($emailPhone)) {
        $_SESSION['error'] = "Please enter your email or phone number.";
        header("Location: forgot_password.php");
        exit();
    }

    // Determine if input is email or phone number
    if (filter_var($emailPhone, FILTER_VALIDATE_EMAIL)) {
        $condition = "email = ?";
    } else if (preg_match("/^[0-9]{10}$/", $emailPhone)) {
        // Normalize phone number if provided
        $phone = preg_replace('/[^0-9]/', '', $emailPhone);
        $phone = '256' . substr($phone, -9); // Assuming Uganda's country code is 256
        $condition = "phone = ?";
        $emailPhone = $phone;
    } else {
        $_SESSION['error'] = "Invalid email or phone number format.";
        header("Location: forgot_password.php");
        exit();
    }

    // Check if email or phone exists in the users table
    $query = "SELECT id, email FROM users WHERE $condition";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emailPhone);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Store user information in session for password reset process
        $_SESSION['reset_user_id'] = $user['id'];
        $_SESSION['reset_user_email'] = $user['email'];
        header("Location: reset_password.php");
        exit();
    } else {
        // User with that Email or Phone does not exist
        $_SESSION['error'] = "User not found.";
        header("Location: forgot_password.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Lubega Institute Online Application</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Forgot Password</h3>
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="emailPhone">Email or Phone Number</label>
                                <input type="text" class="form-control" id="emailPhone" name="emailPhone" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
