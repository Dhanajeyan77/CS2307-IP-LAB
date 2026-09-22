<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'recruiter') {
    header("Location: login.php");
    exit();
}
$recruiter_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE recruiter_id = ? ORDER BY created_at DESC");
$stmt->execute([$recruiter_id]);
$jobs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recruiter Dashboard - CareerHub</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .applicant-list { margin-top: 20px; border-top: 2px dashed #eee; padding-top: 15px; }
        .applicant-card { background: #fdfdfd; padding: 15px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #e1e4e8; }
        .applicant-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 14px; margin-bottom: 10px; }
        .applicant-grid div { background: #f4f7f6; padding: 8px; border-radius: 4px; }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo">🚀 CareerHub</a>
        <nav>
            <a href="post_job.php" style="background:#ffc107; color:#111; padding: 8px 15px; border-radius: 20px; text-decoration:none; font-weight:600;">+ Post a New Job</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="container">
        <h3 class="section-title">My Job Postings & Applicants</h3>
        <?php if(count($jobs) > 0): ?>
            <?php foreach($jobs as $job): ?>
                <div class="job-card" style="margin-bottom: 40px; border-left: 5px solid #0056b3;">
                    <h4 class="job-title"><?= htmlspecialchars($job['title']) ?></h4>
                    <span style="font-size:13px; color:#888;">Posted: <?= date('M d, Y', strtotime($job['created_at'])) ?></span>

                    <div class="applicant-list">
                        <h5 style="margin-bottom:15px; color:#111; font-size: 18px;">📥 Applications Received:</h5>
                        <?php
                            $app_stmt = $pdo->prepare("SELECT * FROM applications WHERE job_id = ?");
                            $app_stmt->execute([$job['id']]);
                            $apps = $app_stmt->fetchAll();
                        ?>
                        <?php if(count($apps) > 0): ?>
                            <?php foreach($apps as $app): ?>
                                <div class="applicant-card">
                                    <h4 style="color:#0056b3; margin-bottom: 10px;">👤 <?= htmlspecialchars($app['applicant_name']) ?></h4>

                                    <div class="applicant-grid">
                                        <div><strong>Email:</strong> <?= htmlspecialchars($app['applicant_email']) ?></div>
                                        <div><strong>Phone:</strong> <?= htmlspecialchars($app['phone']) ?></div>
                                        <div><strong>Domain:</strong> <?= htmlspecialchars($app['domain']) ?></div>
                                        <div><strong>Experience:</strong> <?= htmlspecialchars($app['experience']) ?></div>
                                        <div style="grid-column: span 2;"><strong>Education:</strong> <?= htmlspecialchars($app['education']) ?></div>
                                    </div>

                                    <div style="background: #fff; padding: 10px; border: 1px solid #eee; border-radius: 4px; font-size: 14px; margin-bottom: 10px;">
                                        <strong>Description:</strong><br>
                                        <em style="color:#555;">"<?= nl2br(htmlspecialchars($app['cover_letter'])) ?>"</em>
                                    </div>

                                    <a href="<?= htmlspecialchars($app['resume_path']) ?>" target="_blank" class="btn" style="padding: 6px 15px; font-size: 13px;">📄 View/Download Resume</a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="background:#f8f9fa; padding:15px; border-radius:6px; color:#888; text-align:center;">
                                No applications yet for this role.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You haven't posted any jobs yet. <a href="post_job.php">Post one now.</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
