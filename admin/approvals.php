<?php
require_once '../includes/db_connect.php';
require_once '../includes/session.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campaignId = $_POST['campaign_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE campaigns SET active_status = ? WHERE campaign_id = ?");
    $stmt->execute([$status, $campaignId]);
}

$stmt = $pdo->query("SELECT c.*, u.email FROM campaigns c JOIN users u ON c.user_id = u.user_id WHERE c.active_status = '0'");
$campaigns = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campaign Approvals - AWTEN</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="analytics-container">
        <h2 class="glow">📝 Pending Campaigns</h2>

        <?php if (count($campaigns) > 0): ?>
            <div class="table-wrapper">
                <table class="analytics-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>URL</th>
                            <th>Geo</th>
                            <th>Device</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($campaigns as $c): ?>
                        <tr>
                            <td><?= $c['campaign_id'] ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['website_url']) ?></td>
                            <td><?= htmlspecialchars($c['geo_target']) ?></td>
                            <td><?= htmlspecialchars($c['device_target']) ?></td>
                            <td>
                                <form method="post" class="approval-form">
                                    <input type="hidden" name="campaign_id" value="<?= $c['campaign_id'] ?>">
                                    <select name="status" class="approval-select">
                                        <option value="1">Approve</option>
                                        <option value="2">Reject</option>
                                    </select>
                                    <button type="submit" class="btn small">Submit</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-data">🎉 No campaigns pending approval!</p>
        <?php endif; ?>

        <p class="register-link">
            <a href="dashboard.php">← Back to Dashboard</a>
        </p>
    </div>
</body>
</html>
