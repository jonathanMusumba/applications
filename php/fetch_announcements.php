<?php
include 'db.php';

// Fetch announcements
$stmt = $conn->prepare("SELECT * FROM announcements ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();

$announcements = array();
while ($row = $result->fetch_assoc()) {
    $announcements[] = $row;
}

$response = array(
    'announcements' => $announcements
);

echo json_encode($response);

$stmt->close();
$conn->close();
?>
