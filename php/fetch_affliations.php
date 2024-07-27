<?php
include 'db.php';

$sql = "SELECT * FROM affiliations ORDER BY affiliation_name ASC";
$result = $conn->query($sql);

$affiliations = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $affiliations[] = $row;
    }
}

echo json_encode($affiliations);
$conn->close();
?>
