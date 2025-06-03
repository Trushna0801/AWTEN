<?php
require_once 'includes/session.php';
require_once 'includes/db_connect.php';

$stmt = $pdo->prepare("SELECT * FROM traffic_logs WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$logs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Traffic Analytics - AWTEN</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="analytics-container">
        <h2 class="glow">📊 Traffic Analytics</h2>

        <?php if (count($logs) > 0): ?>
            <div class="table-wrapper">
                <table class="analytics-table">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>Browser Info</th>
                            <th>Duration (sec)</th>
                            <th>Visit Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['ip_address']) ?></td>
                            <td><?= htmlspecialchars($log['browser_info']) ?></td>
                            <td><?= htmlspecialchars($log['duration']) ?></td>
                            <td><?= htmlspecialchars($log['created_at']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-data">No traffic logs available.</p>
        <?php endif; ?>

        <p class="register-link"><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
