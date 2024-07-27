<!-- admin/dashboard.php -->
<?php include 'config.php'; ?>
<?php include 'partials/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include 'partials/sidebar.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Posts</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Posts</h5>
                            <p class="card-text">Create, edit, and delete posts.</p>
                            <a href="manage_posts.php" class="btn btn-light">Go to Posts</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Comments</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Comments</h5>
                            <p class="card-text">Review and manage comments.</p>
                            <a href="manage_comments.php" class="btn btn-light">Go to Comments</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Advertisements</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Advertisements</h5>
                            <p class="card-text">Manage site advertisements.</p>
                            <a href="manage_advertisements.php" class="btn btn-light">Go to Advertisements</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Messages</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Messages</h5>
                            <p class="card-text">View and respond to messages.</p>
                            <a href="manage_messages.php" class="btn btn-light">Go to Messages</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header">Notices</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Notices</h5>
                            <p class="card-text">Post important notices.</p>
                            <a href="manage_notices.php" class="btn btn-light">Go to Notices</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
