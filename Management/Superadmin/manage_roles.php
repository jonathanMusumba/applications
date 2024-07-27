<!-- admin/super_admin/manage_roles.php -->
<?php
include '../config.php';
require_login();
require_super_admin();
include '../partials/header.php';

// Fetch roles and users from database
$sql_roles = "SELECT DISTINCT role FROM admins";
$result_roles = $conn->query($sql_roles);

$sql_users = "SELECT id, username, role FROM admins";
$result_users = $conn->query($sql_users);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];
    $update_sql = "UPDATE admins SET role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $new_role, $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_roles.php");
    exit();
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../partials/sidebar.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Roles</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result_users->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                        <select name="new_role" required>
                                            <?php while($role = $result_roles->fetch_assoc()): ?>
                                                <option value="<?php echo $role['role']; ?>" <?php echo ($role['role'] === $row['role']) ? 'selected' : ''; ?>>
                                                    <?php echo $role['role']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <button type="submit" name="update_role" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
