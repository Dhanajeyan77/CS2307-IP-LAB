<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'recruiter') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $description = $_POST['description'];
    $recruiter_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO jobs (recruiter_id, title, company, location, salary, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$recruiter_id, $title, $company, $location, $salary, $description]);
    header("Location: index.php?posted=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job - CareerHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">🚀 CareerHub</a>
        <nav><a href="recruiter_dashboard.php">My Listings</a><a href="logout.php">Logout</a></nav>
    </header>
    <div class="container">
        <div class="form-container" style="max-width: 600px;">
            <h2>Post a New Job</h2>
            <form method="POST">
                <div class="form-group"><label>Job Title</label><input type="text" name="title" required></div>
                <div class="form-group"><label>Company Name</label><input type="text" name="company" required></div>
                <div class="form-group"><label>Location</label><input type="text" name="location" required></div>
                <div class="form-group"><label>Salary (e.g. ₹10,00,000/yr)</label><input type="text" name="salary" required></div>
                <div class="form-group"><label>Job Description</label><textarea name="description" rows="5" required style="width:100%; padding:10px; border:1px solid #d1d9e6; border-radius:6px; font-family:'Poppins';"></textarea></div>
                <button type="submit" class="btn" style="width:100%;">Publish Job Posting</button>
            </form>
        </div>
    </div>
</body>
</html>
