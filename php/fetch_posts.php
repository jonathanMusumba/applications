<?php
include 'db.php';

// Get the current page from the query parameters, default is 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$posts_per_page = 5; // Number of posts per page
$offset = ($page - 1) * $posts_per_page;

// Fetch posts
$stmt = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $posts_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total number of posts for pagination
$stmt_total = $conn->prepare("SELECT COUNT(*) AS total FROM posts");
$stmt_total->execute();
$total_result = $stmt_total->get_result();
$total_posts = $total_result->fetch_assoc()['total'];

$posts = array();
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$response = array(
    'posts' => $posts,
    'total_posts' => $total_posts,
    'posts_per_page' => $posts_per_page
);

echo json_encode($response);

$stmt->close();
$stmt_total->close();
$conn->close();
?>
