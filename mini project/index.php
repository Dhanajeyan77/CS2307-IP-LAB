<?php
session_start();
require 'db.php';
$stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
$jobs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CareerHub - Online Job Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">🚀 CareerHub</a>
        <nav>
            <?php if(isset($_SESSION['user_id'])): ?>
                <span class="user-greeting">👋 Hello, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>!</span>
                <?php if($_SESSION['role'] == 'recruiter'): ?>
                    <a href="post_job.php" style="background:#ffc107; color:#111;">+ Post a Job</a>
                    <a href="recruiter_dashboard.php">My Listings</a>
                <?php else: ?>
                    <a href="dashboard.php">My Applications</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php" class="btn btn-outline" style="color:white; border-color:white;">Sign Up</a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="hero">
        <h1>Find Your Dream Job Today</h1>
        <p>Browse thousands of job openings from top companies and take the next big step in your career journey.</p>
    </div>

    <div class="container">
        <h3 class="section-title">Latest Openings</h3>

        <?php if(isset($_GET['applied'])): ?>
            <div class="alert alert-success">🎉 Congratulations! Your application has been successfully submitted.</div>
        <?php endif; ?>
        <?php if(isset($_GET['posted'])): ?>
            <div class="alert alert-success">✅ Job successfully posted to the portal!</div>
        <?php endif; ?>

        <div class="job-grid">
            <?php foreach($jobs as $job): ?>
                <div class="job-card">
                    <div>
                        <span class="badge">Active</span>
                        <h4 class="job-title"><?= htmlspecialchars($job['title']) ?></h4>
                        <div class="job-company">🏢 <?= htmlspecialchars($job['company']) ?></div>
                    </div>
                    <div class="job-details">
                        <span>📍 <?= htmlspecialchars($job['location']) ?></span>
                        <span>💰 <?= htmlspecialchars($job['salary']) ?></span>
                    </div>
                    <p><?= htmlspecialchars($job['description']) ?></p>
                    <div class="job-footer">
                        <span style="font-size:12px; color:#888;">Posted <?= date('M d, Y', strtotime($job['created_at'])) ?></span>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <?php if($_SESSION['role'] == 'seeker'): ?>
                                <a href="apply.php?job_id=<?= $job['id'] ?>" class="btn">Apply Now ➔</a>
                            <?php else: ?>
                                <span style="font-size:13px; color:#666;">(Recruiter View)</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-outline">Login to Apply</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
