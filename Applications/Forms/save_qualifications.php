<?php
session_start(); // Start the session

header('Content-Type: application/json');

// Function to handle file uploads
function handleFileUploads($uploadDir) {
    $uploadedFiles = [];
    foreach ($_FILES['supportDocuments']['name'] as $key => $name) {
        if ($_FILES['supportDocuments']['error'][$key] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['supportDocuments']['tmp_name'][$key];
            $fileName = basename($name);
            $uploadFile = $uploadDir . '/' . $fileName;
            
            if (move_uploaded_file($tmpName, $uploadFile)) {
                $uploadedFiles[] = $fileName;
            }
        }
    }
    return $uploadedFiles;
}

// Create directory if not exists
$uploadDir = 'uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$response = [];
$isConfirmed = isset($_POST['isConfirmed']) ? filter_var($_POST['isConfirmed'], FILTER_VALIDATE_BOOLEAN) : false;

if ($isConfirmed) {
    // Handle final submission
    // Example response for demonstration
    $response['success'] = true;
    $response['message'] = 'Final submission received. Data will be processed.';
} else {
    // Handle incremental save
    $qualifications = json_decode($_POST['qualifications'], true);
    
    if (is_array($qualifications)) {
        // Initialize session qualifications if not set
        if (!isset($_SESSION['qualifications'])) {
            $_SESSION['qualifications'] = [];
        }

        // Update session with new qualifications data
        $_SESSION['qualifications'] = $qualifications;

        $response['success'] = true;
        $response['message'] = 'Qualifications data saved to session.';

        // Handle file uploads
        $uploadedFiles = handleFileUploads($uploadDir);
        if (!empty($uploadedFiles)) {
            $response['files'] = $uploadedFiles;
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'No valid qualifications data provided.';
    }
}

// Output the response as JSON
echo json_encode($response);
?>
