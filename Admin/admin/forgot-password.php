<?php
session_start();

// Directly specify your MySQL connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions

// Check connection
if (!$pdo) {
    die("Connection failed: " . $pdo->errorInfo());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ip_address = $_SERVER['REMOTE_ADDR']; // Get user's IP address
    $email = $_POST['email'];

    // Check if IP address is blocked
    $query = "SELECT * FROM blocked_ips WHERE ip_address = :ip_address";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':ip_address' => $ip_address]);
    $blocked_ip = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($blocked_ip) {
        $_SESSION['error'] = 'Unsuspicious Activity Detected. IP address Blocked for 48 hours.';
        header('Location: login-admin.php');
        exit;
    }

    // Check if email exists in the database
    $query = "SELECT * FROM login_admin WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Proceed to reset password (Redirect to reset_password.php with email as parameter)
        header('Location: reset-password.php?email=' . urlencode($email));
        exit;
    } else {
        // Record failed attempt and block IP if necessary
        recordFailedAttempt($pdo, $ip_address);
        $_SESSION['error'] = 'Email not found. Please try again.';
        header('Location: forgot-password.php');
        exit;
    }
}

function recordFailedAttempt($pdo, $ip_address) {
    $query = "INSERT INTO failed_attempts (ip_address, attempt_time) VALUES (:ip_address, NOW())";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':ip_address' => $ip_address]);

    // Count failed attempts from the last 48 hours
    $query_count = "SELECT COUNT(*) as attempts FROM failed_attempts WHERE ip_address = :ip_address 
                    AND attempt_time >= NOW() - INTERVAL 48 HOUR";
    $stmt_count = $pdo->prepare($query_count);
    $stmt_count->execute([':ip_address' => $ip_address]);
    $attempts = $stmt_count->fetch(PDO::FETCH_ASSOC)['attempts'];

    // If attempts exceed 3, block IP address
    if ($attempts >= 3) {
        $query_block = "INSERT INTO blocked_ips (ip_address, block_time) VALUES (:ip_address, NOW())";
        $stmt_block = $pdo->prepare($query_block);
        $stmt_block->execute([':ip_address' => $ip_address]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Forgot Password</div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
