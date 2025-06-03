<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AWTEN - Welcome</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="hero">
        <div class="overlay">
            <h1 class="glow">Web Spark Exchange</h1>
            <p>Drive real human traffic to your website using the most advanced traffic exchange engine.</p>
            <div class="buttons">
                <a href="login.php" class="btn primary">🚀 Login</a>
                <a href="register.php" class="btn secondary">🧭 Register</a>
            </div>
            <div class="features">
                <div class="card">✅ Real Traffic</div>
                <div class="card">📈 Analytics</div>
                <div class="card">🔁 Auto Exchange</div>
            </div>
        </div>
    </div>
</body>
</html>
