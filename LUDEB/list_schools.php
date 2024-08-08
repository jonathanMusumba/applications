<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Schools</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Schools</h1>
        <div class="row mb-3">
            <div class="col">
                <select class="form-control" id="examYear" name="examYear">
                    <?php
                    // Fetch exam years from database
                    $servername = "localhost";
                    $username = "root"; // Use your database username
                    $password = ""; // Use your database password
                    $dbname = "ludeb"; // Use your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $result = $conn->query("SELECT DISTINCT exam_year FROM exam_years ORDER BY exam_year DESC");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['exam_year'] . "'>" . $row['exam_year'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Center No.</th>
                    <th>Name</th>
                    <th>Sub County</th>
                    <th>Status</th>
                    <th>Registration Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch schools data from database
                $result = $conn->query("SELECT * FROM schools");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['CenterNo'] . "</td>";
                    echo "<td>" . $row['school_Name'] . "</td>";
                    echo "<td>" . $row['Sub_county'] . "</td>";
                    echo "<td><span class='badge badge-success'>" . $row['status'] . "</span></td>";
                    echo "<td><span class='badge badge-info'>" . $row['resultsStatus'] . "</span></td>";
                    echo "<td><a href='view_school.php?center_no=" . $row['centerNo'] . "' class='btn btn-primary'>Action</a></td>";
                    echo "</tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
