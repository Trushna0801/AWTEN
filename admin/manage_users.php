<?php
require_once '../includes/db_connect.php';
require_once '../includes/session.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM users WHERE role != 'admin'");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2 class="glow">👥 Manage Users</h2>

        <?php if (count($users) > 0): ?>
            <div class="table-wrapper">
                <table class="analytics-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Credits</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= $user['credits'] ?></td>
                            <td>
                                <form method="post" action="delete_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit" class="btn small danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-data">No users found.</p>
        <?php endif; ?>

        <p class="register-link">
            <a href="dashboard.php">← Back to Dashboard</a>
        </p>
    </div>
</body>
</html>
