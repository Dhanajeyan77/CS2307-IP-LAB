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
            $fname = trim($_POST['fname'] ?? '');
            $lname = trim($_POST['lname'] ?? '');
            $dob = $_POST['dob'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $password = $_POST['password'] ?? '';
            $cc = $_POST['cc'] ?? '';
            $email = trim($_POST['email'] ?? '');
            $phone = $_POST['phone'] ?? '';
            $errors = [];

            if (empty($fname) || empty($lname)) {
                $errors[] = "First name and last name are required.";
            }
            if (empty($dob) || empty($gender)) {
                $errors[] = "Date of birth and gender are required.";
            }

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
                echo "<p style='text-align:center; font-size: 18px; color: #444;'>Welcome aboard, <strong>" . htmlspecialchars($fname) . " " . htmlspecialchars($lname) . "</strong>!</p>";
                echo "<p style='text-align:center; color: #666;'>We've sent a confirmation to " . htmlspecialchars($email) . ".</p>";
            } else {
                echo "<h2>Validation Errors</h2>";
                echo "<ul class='error'>";
                foreach ($errors as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                echo "</ul>";
            }
        } else {
            echo "<h2>Error</h2>";
            echo "<p style='text-align:center;'>Invalid request method.</p>";
        }
        ?>
        <a href="index.html" class="back-link">&larr; Go Back to Form</a>
    </div>
</body>
</html>
