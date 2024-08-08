<?php
session_start();

// Unset and destroy session
session_unset();
session_destroy();

// Set a session variable to show toast message
$_SESSION['logout_message'] = 'You have been logged out successfully.';

// Redirect to index.php after a short delay to show the toast
header("Location: ../index.php");
exit();
?>

