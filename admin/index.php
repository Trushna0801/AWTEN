<?php
require_once '../includes/db_connect.php';
require_once '../includes/session.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['user_id'];
        $_SESSION['role'] = 'admin';
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "❌ Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - AWTEN</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2 class="glow">🔐 Admin Login</h2>

            <?php if (!empty($error)): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>

            <form method="post" class="login-form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" class="btn primary full-width">Login</button>
            </form>

            <p class="register-link"><a href="../index.php">← Back to Main Site</a></p>
        </div>
    </div>
</body>
</html>
