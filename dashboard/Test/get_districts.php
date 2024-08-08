<?php
header('Content-Type: application/json');

// Database connection parameters
$host = 'localhost';
$dbname = 'linms';
$user = 'root';
$password = '';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch districts
    $stmt = $pdo->query("SELECT district_name FROM districts");
    
    // Fetch all districts
    $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return districts as JSON
    echo json_encode($districts);
} catch (PDOException $e) {
    // Handle errors
    echo json_encode(['error' => $e->getMessage()]);
}
