<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View all announcements from Lubega Institute of Nursing and Health Professionals.">
    <meta name="keywords" content="announcements, Lubega Institute, medical, business, food science">
    <meta name="author" content="Lubega Institute">
    <title>All Announcements</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>All Announcements</h2>
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

        // Pagination settings
        $results_per_page = 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $results_per_page;

        // Fetch announcements with pagination
        $sql = "SELECT id, title, date_posted, content FROM announcements ORDER BY date_posted DESC LIMIT $offset, $results_per_page";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="list-group">';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="list-group-item">';
                echo '<h5 class="mb-1">' . htmlspecialchars($row['title']) . '</h5>';
                echo '<p class="mb-1">' . htmlspecialchars($row['content']) . '</p>';
                echo '<small>' . htmlspecialchars($row['date_posted']) . '</small>';
                echo '</div>';
            }
            echo '</div>';

            // Pagination links
            $total_sql = "SELECT COUNT(*) AS total FROM announcements";
            $total_result = $conn->query($total_sql);
            $total_row = $total_result->fetch_assoc();
            $total_pages = ceil($total_row['total'] / $results_per_page);

            echo '<nav aria-label="Page navigation">';
            echo '<ul class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $active_class = ($i == $page) ? ' active' : '';
                echo '<li class="page-item' . $active_class . '"><a class="page-link" href="announcements.php?page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
            echo '</nav>';
        } else {
            echo '<p>No announcements available.</p>';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
