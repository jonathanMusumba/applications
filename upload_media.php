<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory where files will be uploaded
    $uploadDir = 'Carousels/';
    
    // Check if the directory exists; create if not
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Handle file upload
    if (isset($_FILES['mediaFile']) && $_FILES['mediaFile']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['mediaFile']['tmp_name'];
        $fileName = $_FILES['mediaFile']['name'];
        $fileSize = $_FILES['mediaFile']['size'];
        $fileType = $_FILES['mediaFile']['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // List of allowed file extensions
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        
        // Validate file extension
        if (in_array($fileExtension, $allowedExts)) {
            // Generate new file name to avoid collisions
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                echo 'File is successfully uploaded.';
            } else {
                echo 'Error moving the file.';
            }
        } else {
            echo 'Invalid file extension.';
        }
    } else {
        echo 'No file uploaded or upload error.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Media</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Upload Media</h2>
    <form action="upload_media.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="mediaFile">Choose file</label>
            <input type="file" class="form-control-file" id="mediaFile" name="mediaFile" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
