<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View School</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="list_schools.php">Schools</a></li>
                <li class="breadcrumb-item active" aria-current="page">View School</li>
            </ol>
        </nav>
        <?php
        // Get center number from URL
        $center_no = $_GET['CenterNo'];

        // Database configuration
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

        // Fetch school data from database
        $result = $conn->query("SELECT * FROM schools WHERE CenterNo = '$center_no'");
        $school = $result->fetch_assoc();
        ?>
        <h2 class="text-center">School Profile</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>School Name: <?php echo $school['name']; ?></h4>
                <p>Sub County: <?php echo $school['Sub_county']; ?></p>
                <p>School Type: <?php echo $school['School_type']; ?></p>
                <p>Status: <span class='badge badge-success'><?php echo $school['resultsStatu']; ?></span></p>
            </div>
            <div class="col-md-6">
                <a href="download_results.php?center_no=<?php echo $center_no; ?>" class="btn btn-success mb-3">Download Results (Excel)</a>
                <a href="download_results_pdf.php?center_no=<?php echo $center_no; ?>" class="btn btn-primary mb-3">Download Results (PDF)</a>
                <form action="upload_candidates.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Upload Candidates:</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-info">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
