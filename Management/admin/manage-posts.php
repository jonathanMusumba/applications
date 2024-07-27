<?php
session_start();
include 'php/db.php';

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['admin']) || $_SESSION['admin_role'] !== 'superadmin') {
    header('Location: login.php');
    exit();
}

// Fetch posts
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

$posts = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

$conn->close();
include 'topbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container">
        <h1>Manage Posts</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['id']); ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars(substr($post['content'], 0, 50)); ?>...</td>
                        <td>
                            <a href="edit_post.php?id=<?php echo htmlspecialchars($post['id']); ?>">Edit</a>
                            <a href="delete_post.php?id=<?php echo htmlspecialchars($post['id']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
