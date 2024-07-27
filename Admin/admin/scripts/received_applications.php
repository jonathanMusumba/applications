<?php
/*
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the current year from the intakes table
$query = "SELECT MAX(intake_year) AS currentYear FROM intakes";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentYear = $row['currentYear'];
} else {
    // Default to current year if no intakes data found
    $currentYear = date('Y');
}

// Handle form submission for search
$searchTerm = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'createDate'; // Default sort by createDate
$filterCourse = isset($_GET['course']) ? $_GET['course'] : '';
$filterLevel = isset($_GET['level']) ? $_GET['level'] : '';
$filterEntryType = isset($_GET['entryType']) ? $_GET['entryType'] : '';

// Build the SQL query based on filters
$sql = "SELECT * FROM applications WHERE YEAR(createDate) = $currentYear";

// Apply search term
if (!empty($searchTerm)) {
    $searchTerm = "%$searchTerm%";
    $sql .= " AND (surname LIKE '$searchTerm' OR otherNames LIKE '$searchTerm')";
}

// Apply sorting and filtering
$sql .= " ORDER BY $sortBy";
if (!empty($filterCourse)) {
    $sql .= " AND course = '$filterCourse'";
}
if (!empty($filterLevel)) {
    $sql .= " AND level = '$filterLevel'";
}
if (!empty($filterEntryType)) {
    $sql .= " AND entryType = '$filterEntryType'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Received Applications</h1>

        <!-- Search form -->
        <form method="post" id="searchForm" class="form-inline mb-4">
            <div class="form-group mx-sm-3 mb-2">
                <label for="search" class="sr-only">Search</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Search by Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
            <button type="button" id="clearSearch" class="btn btn-secondary mb-2 ml-2">Clear</button>
        </form>

        <!-- Applications table -->
        <table id="applicationsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Salutation</th>
                    <th>Surname</th>
                    <th>Other Names</th>
                    <th>Date of Birth</th>
                    <th>Sex</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>District</th>
                    <th>Scheme</th>
                    <th>Level</th>
                    <th>Course</th>
                    <th>Form ID</th>
                    <th>Created on</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = $result->fetch_assoc()):
                    // Determine status color based on submission
                    $statusClass = ($row['Status'] == 'submitted') ? 'text-success' : 'text-danger';
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['Salutation']); ?></td>
                        <td><?php echo htmlspecialchars($row['surname']); ?></td>
                        <td><?php echo htmlspecialchars($row['otherNames']); ?></td>
                        <td><?php echo htmlspecialchars($row['dob']); ?></td>
                        <td><?php echo htmlspecialchars($row['sex']); ?></td>
                        <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['district']); ?></td>
                        <td><?php echo htmlspecialchars($row['entryType']); ?></td>
                        <td><?php echo htmlspecialchars($row['level']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['FormID']); ?></td>
                        <td><?php echo htmlspecialchars($row['createDate']); ?></td>
                        <td><span class="<?php echo $statusClass; ?>"><?php echo htmlspecialchars($row['Status']); ?></span></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Handle form submission for search
            $('#searchForm').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'received_applications.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#applicationsTable tbody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Handle clear search button
            $('#clearSearch').on('click', function() {
                $('#search').val('');
                $('#searchForm').submit(); // Submit the form to load all applications
            });
        });
    </script>
</body>
</html>
