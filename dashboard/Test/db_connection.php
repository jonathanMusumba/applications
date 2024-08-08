<?php
function getDbConnection() {
    // Database credentials
    $host = 'localhost';
    $dbname = 'linms';
    $username = 'root'; // Update this to your database username
    $password = '';     // Update this to your database password

    // Create a new MySQLi instance
    $mysqli = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($mysqli->connect_error) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection error: ' . $mysqli->connect_error]);
        exit();
    }

    return $mysqli;
}
?>
