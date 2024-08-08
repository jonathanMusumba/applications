<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$term = $_GET['term'] ?? '';

// Fetch centers based on the provided term (which is School Name)
$query = "SELECT CenterNo, Center_Name FROM sec_schools WHERE Center_Name LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = "%{$term}%";
$stmt->bind_param('s', $searchTerm);
$stmt->execute();

$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'CenterNo' => $row['CenterNo'],
        'Center_Name' => $row['Center_Name']
    ];
}

// Return data as JSON response
header('Content-Type: application/json');
echo json_encode($data);

$stmt->close();
$conn->close();
?>
