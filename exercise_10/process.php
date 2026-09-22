<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST['password'] ?? '';
            $cc = $_POST['cc'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $errors = [];

            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
                $errors[] = "Password needs 8+ chars, 1 uppercase, 1 lowercase, 1 number.";
            }
            if (!preg_match("/^\d{16}$/", str_replace([' ', '-'], '', $cc))) {
                $errors[] = "Invalid Credit Card format. Must be 16 digits.";
            }
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                $errors[] = "Invalid email format.";
            }
            if (!preg_match("/^\d{10}$/", str_replace([' ', '-', '(', ')'], '', $phone))) {
                $errors[] = "Invalid phone number format. Must be 10 digits.";
            }

            if (empty($errors)) {
                echo "<div class='success'>Registration Successful!</div>";
                echo "<p style='text-align:center;'>Welcome, " . htmlspecialchars($email) . "</p>";
            } else {
                echo "<h2>Validation Errors</h2>";
                echo "<ul class='error'>";
                foreach ($errors as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                echo "</ul>";
            }
        }
        ?>
        <a href="index.html" class="back-link">Go Back to Form</a>
    </div>
</body>
</html>
