<?php
/*
session_start();

$error = '';
*/
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Users</h1>

        <!-- Search input -->
        <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search users...">
        </div>

        <!-- User table -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Surname</th>
                    <th>Other Names</th>
                    <th>Date of Birth</th>
                    <th>Sex</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Nationality</th>
                    <th>Creation Date</th>
                    <th>Applicant Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
            <?php
                // Include fetch_users.php content here
                require_once 'fetch_users.php';
                ?><!-- User data will be loaded dynamically here -->
            </tbody>
        </table>

        <!-- Modal for displaying user profile -->
        <!-- Modal for displaying user profile -->
        <div class="modal fade" id="userProfileModal" tabindex="-1" role="dialog" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userProfileModalLabel">User Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="userProfileModalBody">
                <!-- User profile details will be loaded dynamically here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update Details</button>
            </div>
        </div>
    </div>
</div>
<!-- User table -->



    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script for fetching and displaying users -->
    <script>
        $(document).ready(function() {
            fetchUsers(); // Initial fetch

            // Search input event listener
            $('#searchInput').on('input', function() {
                fetchUsers($(this).val());
            });

            // Function to fetch users based on search query
            function fetchUsers(query = '') {
                $.ajax({
                    url: 'fetch_users.php',
                    method: 'POST',
                    data: { query: query },
                    success: function(data) {
                        $('#userTableBody').html(data);
                    }
                });
            }

            // Modal for displaying user profile
            $('#userTableBody').on('click', '.viewProfile', function() {
        var userId = $(this).data('userid');
        $.ajax({
            url: 'fetch_profile.php',
            method: 'POST',
            data: { userId: userId },
            success: function(data) {
                $('#userProfileModalBody').html(data);
                $('#userProfileModal').modal('show');
            }
        });
    });
        });
    </script>
</body>
</html>
