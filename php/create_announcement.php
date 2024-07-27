<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'] ?? 'active';

    $stmt = $conn->prepare("INSERT INTO announcements (title, content, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $status);

    if ($stmt->execute()) {
        echo "<p>Announcement created successfully.</p>";
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
    <title>Create Announcement</title>
</head>
<body>
    <h1>Create Announcement</h1>
    <form action="" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select><br><br>

        <input type="submit" value="Create Announcement">
    </form>
</body>
</html>
