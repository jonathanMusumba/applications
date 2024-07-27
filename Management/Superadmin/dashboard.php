<!-- admin/super_admin/dashboard.php -->
<?php
include 'config.php';

// Add debugging output
echo "Current URL: " . $_SERVER['REQUEST_URI'];

// Make sure these functions are correctly implemented
require_login();
require_super_admin();

// Include partials
include '../partials/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../partials/sidebar.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Super Admin Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Manage Users</div>
                        <div class="card-body">
                            <h5 class="card-title">User Management</h5>
                            <p class="card-text">Add, edit, and delete users.</p>
                            <a href="manage_users.php" class="btn btn-light">Go to Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Manage Roles</div>
                        <div class="card-body">
                            <h5 class="card-title">Role Management</h5>
                            <p class="card-text">Assign roles to users.</p>
                            <a href="manage_roles.php" class="btn btn-light">Go to Roles</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">System Settings</div>
                        <div class="card-body">
                            <h5 class="card-title">System Configuration</h5>
                            <p class="card-text">Manage system settings.</p>
                            <a href="system_settings.php" class="btn btn-light">Go to Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
