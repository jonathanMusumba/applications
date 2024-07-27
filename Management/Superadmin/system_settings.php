<!-- superadmin/settings.php -->
<?php include 'config.php'; ?>
<?php include 'partials/header.php'; ?>

<div class="container">
    <h2>System Settings</h2>
    <form action="update_settings.php" method="post">
        <div class="mb-3">
            <label for="site_name" class="form-label">Site Name</label>
            <input type="text" class="form-control" id="site_name" name="site_name" value="Your Site Name" required>
        </div>
        <!-- Add more settings fields as needed -->
        <button type="submit" class="btn btn-primary">Update Settings</button>
    </form>
</div>

<?php include 'partials/footer.php'; ?>
