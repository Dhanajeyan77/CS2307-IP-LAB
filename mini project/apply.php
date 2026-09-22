<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'seeker') {
    header("Location: index.php");
    exit();
}

$job_id = $_GET['job_id'] ?? $_POST['job_id'] ?? null;
if (!$job_id) { header("Location: index.php"); exit(); }

$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();
if (!$job) { die("Job not found."); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $applicant_name = $_POST['applicant_name'];
    $applicant_email = $_POST['applicant_email'];
    $phone = $_POST['phone'];
    $domain = $_POST['domain'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];
    $cover_letter = $_POST['cover_letter'];

    $check = $pdo->prepare("SELECT * FROM applications WHERE user_id = ? AND job_id = ?");
    $check->execute([$user_id, $job_id]);
    if ($check->rowCount() > 0) {
        $error = "You have already applied for this job.";
    } else {
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
            $allowed = ['pdf', 'doc', 'docx'];
            $filename = $_FILES['resume']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (in_array(strtolower($ext), $allowed)) {
                $new_filename = time() . "_" . $user_id . "." . $ext;
                $dest = "uploads/" . $new_filename;
                move_uploaded_file($_FILES['resume']['tmp_name'], $dest);

                $stmt = $pdo->prepare("INSERT INTO applications (user_id, job_id, applicant_name, applicant_email, phone, domain, experience, education, cover_letter, resume_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$user_id, $job_id, $applicant_name, $applicant_email, $phone, $domain, $experience, $education, $cover_letter, $dest]);
                header("Location: index.php?applied=1");
                exit();
            } else {
                $error = "Invalid file type. Only PDF and DOCX are allowed.";
            }
        } else {
            $error = "Please upload a resume.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for Job - CareerHub</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo">🚀 CareerHub</a>
        <nav><a href="dashboard.php">My Applications</a><a href="logout.php">Logout</a></nav>
    </header>
    <div class="container" style="padding-bottom: 50px;">
        <div class="form-container" style="max-width: 700px; margin-top: 30px;">
            <h2>Apply for: <?= htmlspecialchars($job['title']) ?></h2>
            <p style="text-align:center; color:#666; margin-bottom:20px;">🏢 <?= htmlspecialchars($job['company']) ?></p>
            <?php if(isset($error)): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="job_id" value="<?= $job['id'] ?>">

                <div class="grid-2">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="applicant_name" value="<?= htmlspecialchars($_SESSION['user_name']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="email" name="applicant_email" required>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" placeholder="+91 9876543210" required>
                    </div>
                    <div class="form-group">
                        <label>Job Domain / Role</label>
                        <input type="text" name="domain" placeholder="e.g. Web Development" required>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Years of Experience</label>
                        <input type="text" name="experience" placeholder="e.g. 2 Years" required>
                    </div>
                    <div class="form-group">
                        <label>Highest Education</label>
                        <input type="text" name="education" placeholder="e.g. B.Tech CSE" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Description / Cover Letter</label>
                    <textarea name="cover_letter" rows="4" placeholder="Briefly describe your skills..." required style="width:100%; padding:10px; border:1px solid #d1d9e6; border-radius:6px; font-family:'Poppins';"></textarea>
                </div>

                <div class="form-group" style="background:#f4f7f6; padding:15px; border-radius:6px;">
                    <label style="color:#0056b3;">📄 Upload Resume (PDF/DOCX)</label>
                    <input type="file" name="resume" accept=".pdf,.doc,.docx" required style="border:none; padding:0;">
                </div>

                <button type="submit" class="btn" style="width:100%; margin-top: 10px; font-size: 16px;">Submit Application</button>
            </form>
        </div>
    </div>
</body>
</html>
