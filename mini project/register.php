<?php
session_start();
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role]);
        header("Location: login.php");
        exit();
    } catch(PDOException $e) {
        $error = "This email is already registered!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - CareerHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">🚀 CareerHub</a>
        <nav><a href="login.php" class="btn btn-outline" style="color:white; border-color:white;">Login</a></nav>
    </header>
    <div class="container" style="flex:1; display:flex; align-items:center;">
        <div class="form-container">
            <h2>Create Your Profile</h2>
            <?php if(isset($error)): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>I am a...</label>
                    <select name="role" required style="width: 100%; padding: 12px 15px; border: 1px solid #d1d9e6; border-radius: 6px; font-family: 'Poppins', sans-serif;">
                        <option value="seeker">Job Seeker (Looking for jobs)</option>
                        <option value="recruiter">Recruiter (Posting jobs)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="e.g. John Doe" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="e.g. john@example.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a strong password" required minlength="6">
                </div>
                <button type="submit" class="btn" style="width:100%; margin-top:10px;">Register Account</button>
            </form>
            <p style="text-align:center; margin-top:25px; font-size:14px; color:#666;">Already have an account? <a href="login.php" style="color:#0056b3; font-weight:600; text-decoration:none;">Log in here</a></p>
        </div>
    </div>
</body>
</html>
