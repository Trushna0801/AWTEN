<?php
require_once 'includes/session.php';
require_once 'includes/db_connect.php';

// Fetch one approved campaign that is not owned by the current user
$stmt = $pdo->prepare("SELECT campaign_id, website_url FROM campaigns WHERE active_status = 1 AND user_id != ?");
$stmt->execute([$_SESSION['user_id']]);
$campaign = $stmt->fetch();

$campaignUrl = $campaign ? $campaign['website_url'] : null;
$campaignId = $campaign ? $campaign['campaign_id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Traffic Exchange - AWTEN</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        let start = Date.now();
        function trackVisit() {
            let duration = Math.floor((Date.now() - start) / 1000);
            fetch('traffic_engine/verifier.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `user_id=<?= $_SESSION['user_id'] ?>&campaign_id=<?= $campaignId ?>&duration=${duration}&visited_url=<?= urlencode($campaignUrl) ?>`
            })
            .then(res => res.json())
            .then(data => alert(data.message))
            .catch(err => alert('Error: ' + err));
        }
    </script>
</head>
<body>
    <div class="exchange-container">
        <h2 class="glow">🔁 Traffic Exchange In Progress</h2>

        <?php if ($campaignUrl): ?>
            <div class="iframe-box">
                <iframe src="<?= htmlspecialchars($campaignUrl) ?>" width="100%" height="600px" frameborder="0"></iframe>
            </div>
            <button onclick="trackVisit()" class="btn primary finish-btn">Finish Visit</button>
        <?php else: ?>
            <p class="no-data">🚫 No campaigns available for exchange right now. Please try again later.</p>
        <?php endif; ?>
    </div>
</body>
</html>
