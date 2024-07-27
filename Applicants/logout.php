<?php
session_start();

// Check if form status is 'Pending'
if ($_SESSION['form_status'] === 'Pending') {
    // Connect to your database (adjust with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare data for insertion
    $userId = $_SESSION['user_id'];
    $formData = $_SESSION['form_data']; // Assuming 'form_data' is stored in session

    // Insert form data into 'applications' table
    $stmt = $conn->prepare("INSERT INTO applications (user_id, form_data) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $formData);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}

// Unset all of the session variables
$_SESSION = [];

// Destroy the session cookie if it exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: ../index.php");
exit();
?>
