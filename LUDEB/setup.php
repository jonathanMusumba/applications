<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Examination System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            margin-top: 50px;
        }

        .form-group label {
            color: #fff;
        }

        h1,
        h2 {
            color: #ffd700;
        }

        .btn-primary {
            background-color: #ffd700;
            border: none;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #ffc107;
        }

        .form-control,
        .form-control-file {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Setup Examination System</h1>
        <form id="setupForm" action="php/setup.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="logo">Upload Logo:</label>
                <input type="file" class="form-control-file" id="logo" name="logo">
            </div>
            <div class="form-group">
                <label for="boardName">Examination Board Name:</label>
                <input type="text" class="form-control" id="boardName" name="boardName" required>
            </div>
            <div class="form-group">
                <label for="examYear">Examination Year:</label>
                <input type="number" class="form-control" id="examYear" name="examYear" required>
            </div>
            <h2>System Users</h2>
            <div id="userManagement">
                <!-- User management form elements -->
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username[]" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email[]" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password[]" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role[]">
                        <option value="System Admin">System Admin</option>
                        <option value="Examination Administrator">Examination Administrator</option>
                        <option value="Data Entrant">Data Entrant</option>
                    </select>
                </div>
                <!-- Button to add more users -->
                <button type="button" class="btn btn-secondary" id="addUserButton">Add Another User</button>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
        </form>
    </div>

    <script>
        document.getElementById('addUserButton').addEventListener('click', function () {
            const userManagementDiv = document.getElementById('userManagement');
            const userDiv = document.createElement('div');

            userDiv.innerHTML = `
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username[]" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email[]" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password[]" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" name="role[]">
                        <option value="System Admin">System Admin</option>
                        <option value="Examination Administrator">Examination Administrator</option>
                        <option value="Data Entrant">Data Entrant</option>
                    </select>
                </div>
            `;

            userManagementDiv.appendChild(userDiv);
        });
    </script>
</body>

</html>