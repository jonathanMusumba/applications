<?php
// PHP code to manage applications (approve/reject)
?>
<div class="container">
    <h2>Manage Applications</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Applicant Name</th>
                <th>Scheme</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Example data fetching and displaying
            $query = "SELECT id, applicant_name, scheme, category, status FROM applications";
            $stmt = $pdo->query($query);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['applicant_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['scheme']) . '</td>';
                echo '<td>' . htmlspecialchars($row['category']) . '</td>';
                echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                echo '<td>';
                echo '<a href="approve_application.php?id=' . $row['id'] . '" class="btn btn-success">Approve</a>';
                echo ' ';
                echo '<a href="reject_application.php?id=' . $row['id'] . '" class="btn btn-danger">Reject</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
