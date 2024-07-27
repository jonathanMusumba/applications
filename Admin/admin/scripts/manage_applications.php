<?php

 session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';

$year = isset($_POST['year']) ? $_POST['year'] : date('Y');
$searchTerm = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

// Fetch applications based on year and search term
$query = "SELECT * FROM applications WHERE YEAR(createDate) = ? AND (surname LIKE ? OR otherNames LIKE ?) AND Status = 'submitted'";
$stmt = $conn->prepare($query);
$searchTerm = "%$searchTerm%";
$stmt->bind_param("sss", $year, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Manage Applications</h1>
        <form method="post" class="form-inline mb-4">
            <div class="form-group mx-sm-3 mb-2">
                <label for="year" class="sr-only">Year</label>
                <select id="year" name="year" class="form-control">
                    <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == $year) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="search" class="sr-only">Search</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Search by Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Salutation</th>
                    <th>Applicant Name</th>
                    <th>Level</th>
                    <th>Course</th>
                    <th>Dob</th>
                    <th>Sex</th>
                    <th>Marital Status</th>
                    <th>Religion</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>District</th>
                    <th>Form ID</th>
                    <th>Create Date</th>
                    <th>Submit Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['salutation']); ?></td>
                        <td><?php echo htmlspecialchars($row['surname'] . ' ' . $row['otherNames']); ?></td>
                        <td><?php echo htmlspecialchars($row['level']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['dob']); ?></td>
                        <td><?php echo htmlspecialchars($row['sex']); ?></td>
                        <td><?php echo htmlspecialchars($row['maritalStatus']); ?></td>
                        <td><?php echo htmlspecialchars($row['religion']); ?></td>
                        <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['district']); ?></td>
                        <td><?php echo htmlspecialchars($row['FormID']); ?></td>
                        <td><?php echo htmlspecialchars($row['createDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['submitDate']); ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row['id']; ?>">View</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Applicant Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="applicant-details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="admitButton">Admit Student</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#viewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var applicantId = button.data('id');
            var modal = $(this);

            $.ajax({
                url: 'fetch_applicant.php',
                type: 'POST',
                data: { id: applicantId },
                success: function(response) {
                    modal.find('#applicant-details').html(response);
                }
            });
        });

        $('#admitButton').click(function() {
            // Handle admit student functionality here
        });
    </script>
</body>
</html>

</body>
</html>