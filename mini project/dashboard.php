<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT j.title, j.company, j.location, a.applied_at FROM applications a JOIN jobs j ON a.job_id = j.id WHERE a.user_id = ? ORDER BY a.applied_at DESC");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Dashboard - CareerHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">🚀 CareerHub</a>
        <nav>
            <span class="user-greeting">👋 Hello, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>!</span>
            <a href="index.php">Browse Jobs</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h3 class="section-title">My Applications Tracker</h3>

        <?php if(count($applications) > 0): ?>
            <div class="job-grid">
                <?php foreach($applications as $app): ?>
                    <div class="job-card" style="border-left: 5px solid #28a745;">
                        <span class="badge" style="background:#e6f4ea; color:#1e8e3e; align-self:flex-start;">Status: Under Review</span>
                        <h4 class="job-title"><?= htmlspecialchars($app['title']) ?></h4>
                        <div class="job-company">🏢 <?= htmlspecialchars($app['company']) ?></div>
                        <div class="job-details">
                            <span>📍 <?= htmlspecialchars($app['location']) ?></span>
                        </div>
                        <div class="job-footer" style="margin-top:10px;">
                            <span style="font-size:13px; color:#555;"><strong>Applied On:</strong> <?= htmlspecialchars($app['applied_at']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align:center; padding: 50px; background:white; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
                <h2 style="color:#555; margin-bottom:15px;">You haven't applied for any jobs yet!</h2>
                <a href="index.php" class="btn">Explore Job Opportunities ➔</a>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2026 CareerHub Job Portal. All Rights Reserved.</p>
    </footer>
</body>
</html>
