<?php
require 'database_connection.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];
    $value = $_POST['value'];
    $description = $_POST['description'];
    $academic_year_start = $_POST['academic_year_start'];
    $academic_year_end = $_POST['academic_year_end'];
    $semester_start = $_POST['semester_start'];
    $semester_end = $_POST['semester_end'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO Settings (`key`, `value`, `description`, `academic_year_start`, `academic_year_end`, `semester_start`, `semester_end`, `created_at`, `updated_at`)
            VALUES (:key, :value, :description, :academic_year_start, :academic_year_end, :semester_start, :semester_end, :created_at, :updated_at)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':key', $key);
    $stmt->bindParam(':value', $value);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':academic_year_start', $academic_year_start);
    $stmt->bindParam(':academic_year_end', $academic_year_end);
    $stmt->bindParam(':semester_start', $semester_start);
    $stmt->bindParam(':semester_end', $semester_end);
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':updated_at', $updated_at);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Setting added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add setting.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
