<?php
require_once 'includes/session.php';
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] === 'admin') {
    header("Location: admin/dashboard.php");
    exit;
} elseif ($_SESSION['role'] !== 'user') {
    // Optional fallback
    header("Location: login.php");
    exit;
}

$user = getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - AWTEN</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Welcome, <?= htmlspecialchars($user['username']) ?> 👋</h2>
            <p>You have <strong><?= $user['credits'] ?></strong> traffic credits available.</p>
        </div>

        <div class="dashboard-actions">
            <a href="analytics.php" class="btn dashboard-btn">📊 View Analytics</a>
            <a href="exchange.php" class="btn dashboard-btn">🔁 Start Exchange</a>
            <a href="membership.php" class="btn dashboard-btn">🚀 Upgrade</a>
            <a href="settings.php" class="btn dashboard-btn">⚙️ Settings</a>
            <a href="logout.php" class="btn dashboard-btn danger">🚪 Logout</a>
        </div>
    </div>
</body>
</html>

