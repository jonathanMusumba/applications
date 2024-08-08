<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// User data
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Administrator Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="topbar">
        <button class="btn btn-outline-secondary collapse-btn" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse">
            <i class="fas fa-bars"></i>
        </button>
        <div>
            <span class="mr-3">Board Name: Examination Board</span>
            <span class="mr-3">User Role: Admin</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarCollapse" class="sidebar bg-light">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#schoolsMenu" aria-expanded="false">
                                <i class="fas fa-school"></i> Schools
                            </a>
                            <div id="schoolsMenu" class="collapse">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="#">Add School</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Manage Schools</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersMenu" aria-expanded="false">
                                <i class="fas fa-users"></i> Users
                            </a>
                            <div id="usersMenu" class="collapse">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="#">Add User</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Manage Users</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#studentsMenu" aria-expanded="false">
                                <i class="fas fa-user-graduate"></i> Students
                            </a>
                            <div id="studentsMenu" class="collapse">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="#">Add Student</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Manage Students</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#resultsMenu" aria-expanded="false">
                                <i class="fas fa-file-alt"></i> Results
                            </a>
                            <div id="resultsMenu" class="collapse">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="#">Add Results</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Manage Results</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-file-import"></i> Results Capture
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Number of Schools</h5>
                                <p class="card-text">104</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Schools Results Declared</h5>
                                <p class="card-text">100</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Candidates Registered</h5>
                                <p class="card-text">1200</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Candidates Results Declared</h5>
                                <p class="card-text">1180</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <canvas id="progressiveGraph"></canvas>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <h2>Summary Table</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Division</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>One</td>
                                    <td>200</td>
                                    <td>220</td>
                                    <td>420</td>
                                </tr>
                                <tr>
                                    <td>Two</td>
                                    <td>180</td>
                                    <td>190</td>
                                    <td>370</td>
                                </tr>
                                <tr>
                                    <td>Three</td>
                                    <td>100</td>
                                    <td>120</td>
                                    <td>220</td>
                                </tr>
                                <tr>
                                    <td>Four</td>
                                    <td>50</td>
                                    <td>60</td>
                                    <td>110</td>
                                </tr>
                                <tr>
                                    <td>Ungraded</td>
                                    <td>10</td>
                                    <td>15</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>Absentees</td>
                                    <td>5</td>
                                    <td>10</td>
                                    <td>15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Progressive graph script
        var ctx = document.getElementById('progressiveGraph').getContext('2d');
        var progressiveGraph = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
                datasets: [{
                    label: 'Data Entry Progress',
                    data: [10, 50, 90, 130, 170],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var sidebarCollapseBtn = document.querySelector('.collapse-btn');
            var sidebar = document.getElementById('sidebarCollapse');

            sidebarCollapseBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        });
    </script>
</body>
</html>
