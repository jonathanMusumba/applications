<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $media_title = $_POST['media_title'];
    $media_url = $_POST['media_url'];
    $media_type = $_POST['media_type'];
    $status = $_POST['status'] ?? 'active';

    $stmt = $conn->prepare("INSERT INTO media (media_title, media_url, media_type, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $media_title, $media_url, $media_type, $status);

    if ($stmt->execute()) {
        echo "<p>Media created successfully.</p>";
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
    <title>Create Media</title>
</head>
<body>
    <h1>Create Media</h1>
    <form action="" method="post">
        <label for="media_title">Media Title:</label>
        <input type="text" id="media_title" name="media_title"><br><br>

        <label for="media_url">Media URL:</label>
        <input type="text" id="media_url" name="media_url" required><br><br>

        <label for="media_type">Media Type:</label>
        <select id="media_type" name="media_type" required>
            <option value="image">Image</option>
            <option value="video">Video</option>
            <option value="audio">Audio</option>
        </select><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select><br><br>

        <input type="submit" value="Create Media">
    </form>
</body>
</html>
