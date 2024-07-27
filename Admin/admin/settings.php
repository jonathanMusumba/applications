<?php
session_start();
require_once '../../include/db_config.php'; // Adjust the path as per your file structure

if (!isset($_SESSION['admin_id'])) {
    header("Location: login-admin.php");
    exit();
}

$error = "";
$success = "";

// Fetch current settings
try {
    $stmt = $pdo->prepare("SELECT `key`, `value` FROM settings WHERE `key` IN ('current_academic_year', 'academic_year_start', 'academic_year_end', 'current_semester', 'semester_start', 'semester_end')");
    $stmt->execute();
    $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
} catch (Exception $e) {
    $error = "Failed to fetch settings: " . $e->getMessage();
}

// Check if settings are not set or expired
$settings_exist = isset($settings['current_academic_year']) && isset($settings['academic_year_start']) && isset($settings['academic_year_end'])
    && isset($settings['current_semester']) && isset($settings['semester_start']) && isset($settings['semester_end']);

$current_date = date('Y-m-d');

if (!$settings_exist || $current_date > $settings['semester_end']) {
    // Settings are not set or semester is expired, prompt user to update
    $error = "Please update the current academic year and semester settings.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_academic_year = $_POST['current_academic_year'];
    $academic_year_start = $_POST['academic_year_start'];
    $academic_year_end = $_POST['academic_year_end'];
    $current_semester = $_POST['current_semester'];
    $semester_start = $_POST['semester_start'];
    $semester_end = $_POST['semester_end'];

    try {
        $stmt = $pdo->prepare("UPDATE settings SET `value` = :value WHERE `key` = :key");

        // Update current academic year
        $stmt->execute(['value' => $current_academic_year, 'key' => 'current_academic_year']);
        $stmt->execute(['value' => $academic_year_start, 'key' => 'academic_year_start']);
        $stmt->execute(['value' => $academic_year_end, 'key' => 'academic_year_end']);

        // Update current semester
        $stmt->execute(['value' => $current_semester, 'key' => 'current_semester']);
        $stmt->execute(['value' => $semester_start, 'key' => 'semester_start']);
        $stmt->execute(['value' => $semester_end, 'key' => 'semester_end']);

        $success = "Settings updated successfully.";

        // Redirect to avoid resubmission
        header("Location: admin-settings.php");
        exit();
    } catch (Exception $e) {
        $error = "Failed to update settings: " . $e->getMessage();
    }
}

// Generate academic years
$academic_years = [];
for ($year = 2024; $year <= 2035; $year++) {
    $next_year = $year + 1;
    $academic_years[] = "$year/$next_year";
}

// Semesters
$semesters = ['Semester 1', 'Semester 2'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 800px;
            margin: auto;
            padding-top: 50px;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        
        .btn-container .btn {
            margin-right: 10px;
        }
        
        .form-group label {
            font-weight: bold;
        }
        
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Admin Settings</h3>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="form-group">
                        <label for="current_academic_year">Current Academic Year</label>
                        <select class="form-control" id="current_academic_year" name="current_academic_year" required>
                            <?php foreach ($academic_years as $year): ?>
                                <option value="<?php echo $year; ?>" <?php echo (isset($settings['current_academic_year']) && $settings['current_academic_year'] == $year) ? 'selected' : ''; ?>>
                                    <?php echo $year; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="academic_year_start">Academic Year Start Date</label>
                        <input type="date" class="form-control" id="academic_year_start" name="academic_year_start" value="<?php echo $settings['academic_year_start'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="academic_year_end">Academic Year End Date</label>
                        <input type="date" class="form-control" id="academic_year_end" name="academic_year_end" value="<?php echo $settings['academic_year_end'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="current_semester">Current Semester</label>
                        <select class="form-control" id="current_semester" name="current_semester" required>
                            <?php foreach ($semesters as $semester): ?>
                                <option value="<?php echo $semester; ?>" <?php echo (isset($settings['current_semester']) && $settings['current_semester'] == $semester) ? 'selected' : ''; ?>>
                                    <?php echo $semester; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester_start">Semester Start Date</label>
                        <input type="date" class="form-control" id="semester_start" name="semester_start" value="<?php echo $settings['semester_start'] ?? ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="semester_end">Semester End Date</label>
                        <input type="date" class="form-control" id="semester_end" name="semester_end" value="<?php echo $settings['semester_end'] ?? ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update Settings</button>
                </form>
            </div>
        </div>

        <div class="btn-container">
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
