<?php
require_once '../includes/db_connect.php';
require_once '../includes/session.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$stmt = $pdo->query("SELECT COUNT(*) AS user_count FROM users");
$userCount = $stmt->fetch()['user_count'];

$stmt2 = $pdo->query("SELECT COUNT(*) AS traffic_count FROM traffic_logs");
$trafficCount = $stmt2->fetch()['traffic_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - AWTEN</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2 class="glow">🛡️ Admin Dashboard</h2>
        <div class="admin-stats">
            <div class="stat-box">
                <h3>👤 Total Users</h3>
                <p><?= $userCount ?></p>
            </div>
            <div class="stat-box">
                <h3>📈 Total Traffic Logs</h3>
                <p><?= $trafficCount ?></p>
            </div>
        </div>

        <div class="dashboard-actions">
            <a href="manage_users.php" class="btn dashboard-btn">👥 Manage Users</a>
            <a href="logs.php" class="btn dashboard-btn">🗂 View Logs</a>
            <a href="approvals.php" class="btn dashboard-btn">✅ Approvals</a>
            <a href="../logout.php" class="btn dashboard-btn danger">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
