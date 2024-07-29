<?php
session_start();

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
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category_id = intval($_POST['category_id']);

    // Handle file upload
    $media_path = null;
    if (!empty($_FILES['media']['name'])) {
        $target_dir = "uploads/";
        $media_path = $target_dir . basename($_FILES["media"]["name"]);
        if (move_uploaded_file($_FILES["media"]["tmp_name"], $media_path)) {
            // File uploaded successfully
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    $sql = "INSERT INTO posts (title, content, category_id, media_url, author, date_posted) 
            VALUES ('$title', '$content', $category_id, '$media_path', {$_SESSION['user_id']}, NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "New post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
