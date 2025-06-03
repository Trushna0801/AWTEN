<?php
require_once '../includes/db_connect.php';
require_once '../includes/session.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->query("SELECT tl.*, u.email FROM traffic_logs tl JOIN users u ON tl.user_id = u.user_id ORDER BY tl.created_at DESC LIMIT 100");
$logs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Traffic Logs - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2 class="glow">🗂 Recent Traffic Logs</h2>

        <?php if (count($logs) > 0): ?>
            <div class="table-wrapper">
                <table class="analytics-table">
                    <thead>
                        <tr>
                            <th>User Email</th>
                            <th>IP Address</th>
                            <th>Browser</th>
                            <th>Visited URL</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['email']) ?></td>
                            <td><?= $log['ip_address'] ?></td>
                            <td><?= htmlspecialchars($log['browser_info']) ?></td>
                            <td><?= htmlspecialchars($log['visited_url']) ?></td>
                            <td><?= $log['created_at'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-data">No logs found.</p>
        <?php endif; ?>

        <p class="register-link">
            <a href="dashboard.php">← Back to Dashboard</a>
        </p>
    </div>
</body>
</html>
