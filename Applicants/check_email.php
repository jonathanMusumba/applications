<?php
// check_email.php

// Include database connection
include __DIR__ . '/../db_connection/db_connection.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Prepare SQL query
    $query = "SELECT COUNT(*) FROM users WHERE email = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        // Return response based on email existence
        if ($count > 0) {
            echo 'exists';
        } else {
            echo 'available';
        }
    }
    $conn->close();
}
?>
