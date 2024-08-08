<?php
// Database connection parameters
$host = 'localhost'; // Your database host
$dbname = 'linms'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT id, district_name FROM Districts ORDER BY district_name");
    $stmt->execute();

    // Fetch all districts
    $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the districts in JSON format
    echo json_encode($districts);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
