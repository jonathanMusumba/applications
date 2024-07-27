<?php
/*
session_start();

$error = '';
*/
// Database connection
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



$query = isset($_POST['query']) ? $_POST['query'] : '';

$sql = "SELECT id,surname, otherNames, dob, sex, email, phone, nationality, creation_date, applicantNumber FROM users";

if (!empty($query)) {
    $sql .= " WHERE surname LIKE '%$query%' OR otherNames LIKE '%$query%' OR email LIKE '%$query%'";
}

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['surname'] . '</td>';
        echo '<td>' . $row['otherNames'] . '</td>';
        echo '<td>' . $row['dob'] . '</td>';
        echo '<td>' . $row['sex'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['nationality'] . '</td>';
        echo '<td>' . $row['creation_date'] . '</td>';
        echo '<td>' . $row['applicantNumber'] . '</td>';
        echo '<td><button class="btn btn-sm btn-info viewProfile" data-userid="'.$row['id'].'" data-toggle="tooltip" title="View Profile">View</button></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="10">No users found.</td></tr>';
}

$conn->close();
?>