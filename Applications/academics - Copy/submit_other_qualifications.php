<?php
session_start();
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



function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registrationDetails = isset($_POST['registrationDetails']) ? json_decode($_POST['registrationDetails'], true) : null;

    if ($registrationDetails === null) {
        echo json_encode(["status" => "error", "message" => "Invalid registration details format"]);
        exit;
    }

    $registrationStatus = sanitize($registrationDetails['registrationStatus']);
    $registrationNumber = isset($registrationDetails['registrationNumber']) ? sanitize($registrationDetails['registrationNumber']) : null;
    $yearOfRegistration = isset($registrationDetails['yearOfRegistration']) ? intval($registrationDetails['yearOfRegistration']) : null;
    $yearsWorked = isset($registrationDetails['yearsWorked']) ? intval($registrationDetails['yearsWorked']) : null;

    $qualifications = [];
    if (isset($_POST['qualifications'])) {
        foreach ($_POST['qualifications'] as $qualification) {
            $qualifications[] = [
                'instituteName' => sanitize($qualification['instituteName']),
                'awardObtained' => sanitize($qualification['awardObtained']),
                'startYear' => intval($qualification['startYear']),
                'endYear' => intval($qualification['endYear']),
                'placeOfWork' => sanitize($qualification['placeOfWork']),
                'designation' => sanitize($qualification['designation'])
            ];
        }
    }

    // Handle file uploads
    $targetDir = "uploads/";
    $supportDocuments = [];

    if (isset($_FILES['supportDocuments'])) {
        foreach ($_FILES['supportDocuments']['name'] as $key => $name) {
            $fileName = basename($name);
            $fileSize = $_FILES['supportDocuments']['size'][$key];
            $fileTmp = $_FILES['supportDocuments']['tmp_name'][$key];
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if ($fileType !== 'pdf' || $fileSize > 2 * 1024 * 1024) {
                echo json_encode(["status" => "error", "message" => "Invalid file format or size"]);
                exit;
            }

            $filePath = $targetDir . uniqid() . '.' . $fileType;
            if (move_uploaded_file($fileTmp, $filePath)) {
                $supportDocuments[] = $filePath;
            } else {
                echo json_encode(["status" => "error", "message" => "Error uploading file"]);
                exit;
            }
        }
    }

    $dataToStore = [
        'registrationStatus' => $registrationStatus,
        'registrationNumber' => $registrationNumber,
        'yearOfRegistration' => $yearOfRegistration,
        'yearsWorked' => $yearsWorked,
        'qualifications' => $qualifications,
        'supportDocuments' => $supportDocuments
    ];

    $jsonData = json_encode($dataToStore);

    // Insert data into database
    $sql = "INSERT INTO other_qualifications_information (all_data) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $jsonData);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
