<?php
session_start();
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        if($user['role'] == 'recruiter'){
            header("Location: recruiter_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $error = "Incorrect email or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - CareerHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">🚀 CareerHub</a>
        <nav><a href="register.php" class="btn btn-outline" style="color:white; border-color:white;">Sign Up</a></nav>
    </header>
    <div class="container" style="flex:1; display:flex; align-items:center;">
        <div class="form-container">
            <h2>Welcome Back!</h2>
            <?php if(isset($error)): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="e.g. john@example.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn" style="width:100%; margin-top:10px;">Secure Login</button>
            </form>
            <p style="text-align:center; margin-top:25px; font-size:14px; color:#666;">New to CareerHub? <a href="register.php" style="color:#0056b3; font-weight:600; text-decoration:none;">Create an account</a></p>
        </div>
    </div>
</body>
</html>
