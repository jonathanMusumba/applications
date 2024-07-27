<?php
session_start();
include __DIR__ . '/../db_connection/db_connection.php';

$user_id = $_SESSION['user_id'];
$isConfirmed = $_POST['isConfirmed'] === 'true';

if ($isConfirmed) {
    echo json_encode(['success' => true, 'message' => 'Section marked as completed.']);
    exit();
}

$qualifications = json_decode($_POST['qualifications'], true);

if ($qualifications[0]['status'] === 'N/A') {
    echo json_encode(['success' => true, 'message' => 'Section marked as completed.']);
    exit();
}

foreach ($qualifications as $qualification) {
    $institutionName = $qualification['instituteName'];
    $awardObtained = $qualification['awardObtained'];
    $startYear = $qualification['startYear'];
    $endYear = $qualification['endYear'];
    $placeOfWork = $qualification['placeOfWork'];
    $designation = $qualification['designation'];

    $stmt = $conn->prepare("INSERT INTO apply (user_id, institutionName, awardObtained, startYear, endYear, placeOfWork, designation) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $user_id, $institutionName, $awardObtained, $startYear, $endYear, $placeOfWork, $designation);

    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error saving qualifications.']);
        exit();
    }
}

foreach ($_FILES['supportDocuments']['tmp_name'] as $key => $tmp_name) {
    $file_name = $_FILES['supportDocuments']['name'][$key];
    $file_tmp = $_FILES['supportDocuments']['tmp_name'][$key];
    $file_type = $_FILES['supportDocuments']['type'][$key];
    $file_size = $_FILES['supportDocuments']['size'][$key];

    $upload_dir = '../uploads/' . $user_id . '/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_path = $upload_dir . basename($file_name);

    if (move_uploaded_file($file_tmp, $file_path)) {
        $stmt = $conn->prepare("INSERT INTO support_documents (user_id, file_path, file_type, file_size) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $user_id, $file_path, $file_type, $file_size);
        $stmt->execute();
    }
}

echo json_encode(['success' => true, 'message' => 'Qualifications saved successfully.']);
?>
