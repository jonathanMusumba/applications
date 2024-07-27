<?php
include 'db.php';

$sql = "SELECT * FROM intakes ORDER BY intake_date ASC";
$result = $conn->query($sql);

$intakes = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $intakes[] = $row;
    }
}

echo json_encode($intakes);
$conn->close();
?>
