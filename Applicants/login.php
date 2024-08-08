<?php
session_start();
include __DIR__ . '/../db_connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $emailPhone = htmlspecialchars(trim($_POST['emailPhone']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate input fields
    if (empty($emailPhone) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: index.php");
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
        header("Location: index.php");
        exit();
    }

    // Check if email or phone exists in the users table
    $query = "SELECT id, applicantNumber, email, password, is_verified FROM users WHERE $condition";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emailPhone);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verify password for user
        if (password_verify($password, $user['password'])) {
            if ($user['is_verified']) {
                // Set session variables
                $_SESSION['user_id'] = $user['id']; // Store user id
                $_SESSION['applicant_number'] = $user['applicantNumber']; // Store applicant number
                $_SESSION['logged_in'] = time(); // Store login time for session expiration

                $_SESSION['success'] = "Logged in successfully.";
                header("Location: ../dashboard/home.php"); // Redirect to dashboard or profile
                exit();
            } else {
                // Account not verified
                $_SESSION['error'] = "Your account is not verified.";
                header("Location: index.php");
                exit();
            }
        } else {
            // Wrong password
            $_SESSION['error'] = "Wrong password.";
            header("Location: index.php");
            exit();
        }
    } else {
        // User with that Email or Phone does not exist
        $_SESSION['error'] = "User not found.";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: index.php");
    exit();
}
?>
