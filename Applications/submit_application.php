<?php
// Assuming connection to the database is already established

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    // Add other form data

    // Update the `applications` table
    $sql = "UPDATE applications SET status='submitted', submitDate=NOW() WHERE formID = ?";
    // Assuming $formID is obtained from session or form data

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $formID);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error submitting application']);
        }
    } else {

        echo json_encode(['success' => false, 'message' => 'Error preparing statement']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>