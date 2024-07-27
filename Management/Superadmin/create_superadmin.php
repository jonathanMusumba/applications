<?php
// Include your database connection file
include 'config.php'; 

// Hash the password
$hashedPassword = password_hash('password123', PASSWORD_DEFAULT);

// SQL query to insert the Super Admin
$sql = "INSERT INTO admins (username, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

// Values for the Super Admin
$username = 'Developer';
$email = 'jmprossy@gmail.com';
$role = 'superadmin';

if ($stmt->execute()) {
    echo "Super Admin account created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
