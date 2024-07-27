<?php
session_start();

// Adjust the relative path to db_connection.php based on the directory structure
include __DIR__ . '/../db_connection/db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailPhone = $_POST['emailPhone'];

    // Sanitize input
    $emailPhone = htmlspecialchars($emailPhone, ENT_QUOTES, 'UTF-8');

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT id, email, phone FROM users WHERE email = ? OR phone = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $emailPhone, $emailPhone);
    $stmt->execute();
    $result = $stmt->get_result();
    $applicant = $result->fetch_assoc();

    if ($applicant) {
        // Store applicant ID in session for password reset
        $_SESSION['reset_applicant_id'] = $applicant['id'];
        $_SESSION['reset_method'] = $applicant['email'] === $emailPhone ? 'email' : 'phone';

        // Redirect to password reset page
        header('Location: reset_password.php');
        exit();
    } else {
        $_SESSION['error'] = 'No applicant found with the provided email or phone.';
        header('Location: forgot_password.php');
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
                        <form method="POST">
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
