<?php
require_once 'includes/session.php';
require_once 'includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Membership Plans - AWTEN</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="membership-container">
        <h2 class="glow">🌟 Choose Your Membership</h2>
        <div class="membership-plans">
            <div class="plan-box">
                <h3>Free Plan</h3>
                <ul>
                    <li>✅ Earn credits by visiting sites</li>
                    <li>📉 Limited traffic control</li>
                    <li>⏱️ Standard queue</li>
                </ul>
            </div>

            <div class="plan-box premium">
                <h3>Premium Plan</h3>
                <p class="price">$499 / month</p>
                <ul>
                    <li>🚀 1000 instant credits</li>
                    <li>👑 Priority traffic exposure</li>
                    <li>📊 Advanced analytics</li>
                </ul>

                <form action="payment_gateway_stub.php" method="post">
                    <input type="hidden" name="plan" value="premium">
                    <button type="submit" class="btn primary full-width">Upgrade to Premium</button>
                </form>
            </div>
        </div>

        <p class="register-link">
            <a href="dashboard.php">← Back to Dashboard</a>
        </p>
    </div>
</body>
</html>
