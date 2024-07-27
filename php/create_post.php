<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'] ?? '';
    $status = $_POST['status'] ?? 'draft';

    $stmt = $conn->prepare("INSERT INTO posts (title, content, author, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $author, $status);

    if ($stmt->execute()) {
        echo "<p>Post created successfully.</p>";
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
    <title>Create Post</title>
</head>
<body>
    <h1>Create Post</h1>
    <form action="" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author"><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select><br><br>

        <input type="submit" value="Create Post">
    </form>
</body>
</html>
