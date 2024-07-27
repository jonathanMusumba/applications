<?php
// Directory where the files will be created
$directory = 'C:/xampp/htdocs/Lubega_application/Admin/sidebar/';

// List of sidebar links and their corresponding PHP file names
$sidebarLinks = [
    'registered_users.php',
    'manage_users.php',
    'manage_applications.php',
    'admitted_applicants.php',
    'pending_applicants.php',
    'received_messages.php',
    'sent_messages.php',
    'send_new_message.php',
    'add-admin.php',
    'manage_settings.php',
    'admit_student.php',
    'manage_admissions.php',
    'create_intake.php',
    'manage_intakes.php',
    'set_new.php'
];

// Content for PHP logic and HTML structure
$phpContent = <<<PHP
<?php
session_start();

\$error = '';

// Database connection
\$servername = "localhost";
\$username = "root";
\$password = "";
\$dbname = "LINMS";

// Create connection
\$conn = new mysqli(\$servername, \$username, \$password, \$dbname);

// Check connection
if (\$conn->connect_error) {
    die("Connection failed: " . \$conn->connect_error);
}
?>
PHP;

// Loop through each sidebar link and create the corresponding PHP file
foreach ($sidebarLinks as $filename) {
    $filepath = $directory . $filename;

    // HTML content related to the PHP logic
    $htmlContent = <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$filename</title>
    </head>
    <body>
        <h1>$filename</h1>
        <p>Content related to $filename</p>
    </body>
    </html>
    HTML;

    // Combine PHP logic and HTML content
    $combinedContent = $phpContent . "\n" . $htmlContent;

    // Write content to the file
    file_put_contents($filepath, $combinedContent);

    // Output success message
    echo "Created file: $filepath <br>";
}

echo "All files created successfully!";
?>
