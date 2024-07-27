<?php
// PHP code to fetch applications and display them
?>
<div class="container">
    <h2>Applications</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Applicant Name</th>
                <th>Scheme</th>
                <th>Category</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Example data fetching and displaying
            $query = "SELECT applicant_name, scheme, category, status FROM applications";
            $stmt = $pdo->query($query);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['applicant_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['scheme']) . '</td>';
                echo '<td>' . htmlspecialchars($row['category']) . '</td>';
                echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
