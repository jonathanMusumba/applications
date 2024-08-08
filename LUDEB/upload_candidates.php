<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Use your database username
$password = ""; // Use your database password
$dbname = "ludeb"; // Use your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"]["tmp_name"];

    // Load the Excel file
    require 'vendor/autoload.php';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();

    // Loop through each row of the sheet
    foreach ($sheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue();
        }

        // Insert the data into the database
        $stmt = $conn->prepare("INSERT INTO candidates (column1, column2, column3) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data[0], $data[1], $data[2]);
        $stmt->execute();
    }
    echo "Candidates uploaded successfully.";
} else {
    echo "Error: No file uploaded.";
}

$conn->close();
?>
