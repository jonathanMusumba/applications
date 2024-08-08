<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS LUDEB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Use the database
$conn->select_db("LUDEB");

// Create examination_board table
$sql = "CREATE TABLE IF NOT EXISTS examination_board (
    id INT AUTO_INCREMENT PRIMARY KEY,
    board_name VARCHAR(255) NOT NULL,
    exam_year YEAR NOT NULL,
    logo VARCHAR(255)
)";
$conn->query($sql);

// Create system_users table
$sql = "CREATE TABLE IF NOT EXISTS system_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('System Admin', 'Examination Administrator', 'Data Entrant') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create schools table
$sql = "CREATE TABLE IF NOT EXISTS schools (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    phone VARCHAR(15),
    email VARCHAR(255)
)";
$conn->query($sql);

// Create candidates table
$sql = "CREATE TABLE IF NOT EXISTS candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    school_id INT,
    index_number VARCHAR(255) NOT NULL,
    candidate_name VARCHAR(255) NOT NULL,
    sex ENUM('Male', 'Female') NOT NULL,
    FOREIGN KEY (school_id) REFERENCES schools(id) ON DELETE SET NULL
)";
$conn->query($sql);

// Create subjects table
$sql = "CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(255) NOT NULL
)";
$conn->query($sql);

// Create assessments table
$sql = "CREATE TABLE IF NOT EXISTS assessments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT,
    subject_id INT,
    score DECIMAL(5, 2) NOT NULL,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
)";
$conn->query($sql);

// Create grades table
$sql = "CREATE TABLE IF NOT EXISTS grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT,
    subject_id INT,
    grade VARCHAR(2) NOT NULL,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
)";

$sql = "CREATE TABLE IF NOT EXISTS sub_counties (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    subcounty VARCHAR(255) NOT NULL,
    constituency VARCHAR(255) NOT NULL
);

-- Insert data into sub_counties table
INSERT INTO sub_counties (subcounty, constituency) VALUES
('Luuka Town Council', 'Luuka North'),
('Ikumbya', 'Luuka North'),
('Bulongo', 'Luuka North'),
('Bukoma', 'Luuka North'),
('Bukoova Town Council', 'Luuka North'),
('Bukanga', 'Luuka South'),
('Irongo', 'Luuka South'),
('Kyanvuma Town Council', 'Luuka South'),
('Busalamu Town Council', 'Luuka South'),
('Bulanga Town Council', 'Luuka South'),
('Nawampiti', 'Luuka South'),
('Waibuga', 'Luuka South');

$conn->query($sql);

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $boardName = $_POST['boardName'];
    $examYear = $_POST['examYear'];

    // Handle file upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {
        $logo = "uploads/" . basename($_FILES["logo"]["name"]);
        move_uploaded_file($_FILES["logo"]["tmp_name"], $logo);
    } else {
        $logo = NULL;
    }

    // Insert data into examination_board table
    $stmt = $conn->prepare("INSERT INTO examination_board (board_name, exam_year, logo) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $boardName, $examYear, $logo);
    $stmt->execute();
    $stmt->close();

    // Insert data into users table
    $usernames = $_POST['username'];
    $emails = $_POST['email'];
    $passwords = $_POST['password'];
    $roles = $_POST['role'];

    for ($i = 0; $i < count($usernames); $i++) {
        $hashedPassword = password_hash($passwords[$i], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO system_users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $usernames[$i], $emails[$i], $hashedPassword, $roles[$i]);
        $stmt->execute();
    }

    echo "Setup completed successfully!";
    $stmt->close();
}

$conn->close();
?>