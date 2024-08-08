<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Admissions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .empty-message { font-size: 1.5rem; color: gray; }
        table { width: 100%; margin-top: 20px; }
        table th, table td { text-align: center; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info mt-3">
            <strong>ADMISSION HISTORY</strong>
            <a href="#" class="btn btn-danger btn-sm float-right" onclick="window.location.reload();">Reload</a>
        </div>

        <div id="admissionsContent">
            <!-- Example of admission content -->
            <div class="alert alert-success">
                <strong>Congratulations</strong> you <strong>have been admitted</strong> to the Program: 
                <span class="text-success">Course Name</span> for <span class="text-success">Academic Year</span>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Program Code</th>
                        <th>Program Name</th>
                        <th>Academic Year</th>
                        <th>Intake</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Program Code</td>
                        <td>Program Name</td>
                        <td>Academic Year</td>
                        <td>Intake Month</td>
                    </tr>
                    <!-- Dynamically load admission details here -->
                </tbody>
            </table>

            <div class="alert alert-info">
                No admissions <i class="fas fa-calendar-check empty-message"></i>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
