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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $conn->real_escape_string($_POST['mediaTitle']);
    $description = $conn->real_escape_string($_POST['mediaDescription']);
    $mediaFile = $_FILES['mediaFile'];
    $mediaType = $_POST['mediaType'];

    // Define target directory based on media type
    switch ($mediaType) {
        case 'post':
            $targetDir = "uploads/posts/";
            break;
        case 'carousel':
            $targetDir = "uploads/carousels/";
            break;
        default:
            $targetDir = "uploads/others/";
            break;
    }

    // Create target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Check if file was uploaded
    if ($mediaFile['error'] == UPLOAD_ERR_OK) {
        $targetFile = $targetDir . basename($mediaFile['name']);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an image or video
        $check = getimagesize($mediaFile['tmp_name']);
        if ($check !== false || in_array($fileType, ['mp4', 'avi', 'mov'])) {
            // Check if file already exists
            if (file_exists($targetFile)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size (5MB limit)
            if ($mediaFile['size'] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png" && $fileType != "gif" && $fileType != "mp4" && $fileType != "avi" && $fileType != "mov") {
                echo "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI & MOV files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                // Try to upload file
                if (move_uploaded_file($mediaFile['tmp_name'], $targetFile)) {
                    // Insert media information into the database
                    $sql = "INSERT INTO media (media_url, title, description, media_type, date_uploaded) VALUES ('$targetFile', '$title', '$description', '$mediaType', NOW())";
                    if ($conn->query($sql) === TRUE) {
                        echo "The file ". htmlspecialchars(basename($mediaFile['name'])). " has been uploaded and recorded.";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "File is not an image or video.";
        }
    } else {
        echo "No file was uploaded.";
    }
}

$conn->close();
?>
