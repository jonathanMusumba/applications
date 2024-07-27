<?php
include 'db.php';

// Directory to store uploaded files
$upload_dir = 'uploads/affiliations/';

// Create directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Allowed file types
$allowed_types = ['image/jpeg', 'image/png', 'image/jfif'];
$allowed_exts = ['jpeg', 'jpg', 'png', 'jfif'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $affiliation_name = $_POST['affiliation_name'];
    $description = $_POST['description'];
    $status = $_POST['status'] ?? 'active';

    // Check if file was uploaded without errors
    if (isset($_FILES['affiliation_logo']) && $_FILES['affiliation_logo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['affiliation_logo']['tmp_name'];
        $file_name = basename($_FILES['affiliation_logo']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_type = $_FILES['affiliation_logo']['type'];
        $file_path = $upload_dir . $file_name;

        // Check file type and extension
        if (in_array($file_type, $allowed_types) && in_array($file_ext, $allowed_exts)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($file_tmp, $file_path)) {
                $affiliation_logo = $file_path;
            } else {
                die("Error: Failed to move uploaded file.");
            }
        } else {
            die("Error: Invalid file type. Only JPEG, JPG, PNG, and JFIF files are allowed.");
        }
    } else {
        die("Error: No file uploaded or upload error.");
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO affiliations (affiliation_name, affiliation_logo, description, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $affiliation_name, $affiliation_logo, $description, $status);

    if ($stmt->execute()) {
        echo "<p>Affiliation added successfully.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Affiliation</title>
</head>
<body>
    <h1>Add Affiliation</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="affiliation_name">Affiliation Name:</label>
        <input type="text" id="affiliation_name" name="affiliation_name" required><br><br>

        <label for="affiliation_logo">Affiliation Logo:</label>
    <input type="file" id="affiliation_logo" name="affiliation_logo" accept=".jpeg, .jpg, .png, .jfif"><br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter a description for the affiliation"></textarea><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="active" selected>Active</option>
            <option value="inactive">Inactive</option>
        </select><br><br>

        <input type="submit" value="Add Affiliation">
    </form>
</body>
</html>
