<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'], $_SESSION['logged_in'])) {
    // Calculate session expiration time (30 minutes)
    $session_expiration = 30 * 60; // 30 minutes in seconds

    // Check if last activity time + session expiration time has passed
    if (time() - $_SESSION['logged_in'] > $session_expiration) {
        // Session expired, destroy session and redirect to login page
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        // Update last activity time
        $_SESSION['logged_in'] = time();
    }
} else {
    // User is not logged in, redirect to login page
    header("Location: index.php");
    exit();
}
?>
