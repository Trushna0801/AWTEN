<?php
require_once 'includes/session.php';
require_once 'includes/db_connect.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['password'])) {
        $newpass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        $stmt->execute([$newpass, $_SESSION['user_id']]);
        $success = "✅ Password updated successfully!";
    } else {
        $error = "❌ Please enter a valid password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Settings - AWTEN</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2 class="glow">🔐 Account Settings</h2>

            <?php if ($success): ?>
                <div class="success-message"><?= $success ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" class="login-form">
                <label for="password">New Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" class="btn primary full-width">Update Password</button>
            </form>

            <p class="register-link">
                <a href="dashboard.php">← Back to Dashboard</a>
            </p>
        </div>
    </div>
</body>
</html>
