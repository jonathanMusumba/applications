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

// Check if post_id is provided
if (!isset($_POST['post_id']) || !is_numeric($_POST['post_id'])) {
    die("Invalid post ID.");
}

$post_id = intval($_POST['post_id']);
$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);
$category_id = intval($_POST['category']);

// Handle media upload
$media_path = '';
if (isset($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
    $media_file = $_FILES['media'];
    $media_name = $media_file['name'];
    $media_tmp_name = $media_file['tmp_name'];
    $media_path = 'uploads/' . basename($media_name);
    
    // Move the uploaded file to the uploads directory
    if (!move_uploaded_file($media_tmp_name, $media_path)) {
        die("Failed to upload media.");
    }
}

// Update post in the database
$sql = "UPDATE posts SET title = '$title', content = '$content', category_id = $category_id";
if ($media_path) {
    $sql .= ", media = '$media_path'";
}
$sql .= " WHERE id = $post_id";

if ($conn->query($sql) === TRUE) {
    echo "Post updated successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
