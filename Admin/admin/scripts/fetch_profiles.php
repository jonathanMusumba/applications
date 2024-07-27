<?php
/*
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$userId = $_POST['userId'];

$sql = "SELECT surname, otherNames, dob, sex, email, phone, nationality, creation_date, applicantNumber FROM users WHERE id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<p><strong>Surname:</strong> ' . $row['surname'] . '</p>';
    echo '<p><strong>Other Names:</strong> ' . $row['otherNames'] . '</p>';
    echo '<p><strong>Date of Birth:</strong> ' . $row['dob'] . '</p>';
    echo '<p><strong>Sex:</strong> ' . $row['sex'] . '</p>';
    echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';
    echo '<p><strong>Phone:</strong> ' . $row['phone'] . '</p>';
    echo '<p><strong>Nationality:</strong> ' . $row['nationality'] . '</p>';
    echo '<p><strong>Creation Date:</strong> ' . $row['creation_date'] . '</p>';
    echo '<p><strong>Applicant Number:</strong> ' . $row['applicantNumber'] . '</p>';
} else {
    echo '<p>User not found.</p>';
}

$conn->close();
?>
