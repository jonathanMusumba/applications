<?php
// Function to create a directory if it doesn't exist
function createDirectory($path) {
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
        echo "Directory created: $path\n";
    } else {
        echo "Directory already exists: $path\n";
    }
}

// Function to create a file with basic content
function createFile($filePath, $content) {
    if (!file_exists($filePath)) {
        file_put_contents($filePath, $content);
        echo "File created: $filePath\n";
    } else {
        echo "File already exists: $filePath\n";
    }
}

// Root directory for the project
$rootDir = "school_management_system";

// Directory structure
$directories = [
    "$rootDir/includes",
    "$rootDir/admin",
    "$rootDir/bursar",
    "$rootDir/academics",
    "$rootDir/assets/css",
    "$rootDir/assets/js",
    "$rootDir/assets/images"
];

// Create directories
foreach ($directories as $dir) {
    createDirectory($dir);
}

// File paths and their basic content
$files_content = [
    "$rootDir/includes/header.php" => "<?php\n// Header content\n?>",
    "$rootDir/includes/footer.php" => "<?php\n// Footer content\n?>",
    "$rootDir/index.php" => "<?php\n// Index content\n?>",
    "$rootDir/login.php" => "<?php\n// Login content\n?>",
    "$rootDir/admin/dashboard.php" => "<?php\n// Admin Dashboard content\n?>",
    "$rootDir/admin/manage_teachers.php" => "<?php\n// Manage Teachers content\n?>",
    "$rootDir/admin/manage_classes.php" => "<?php\n// Manage Classes content\n?>",
    "$rootDir/admin/manage_exams.php" => "<?php\n// Manage Exams content\n?>",
    "$rootDir/admin/manage_subjects.php" => "<?php\n// Manage Subjects content\n?>",
    "$rootDir/admin/manage_staff.php" => "<?php\n// Manage Staff content\n?>",
    "$rootDir/academics/dashboard.php" => "<?php\n// Academics Dashboard content\n?>",
    "$rootDir/academics/generate_report.php" => "<?php\n// Generate Report content\n?>"
];

// Create files with basic content
foreach ($files_content as $filePath => $content) {
    createFile($filePath, $content);
}

echo "Directory structure and files created successfully.\n";
?>
