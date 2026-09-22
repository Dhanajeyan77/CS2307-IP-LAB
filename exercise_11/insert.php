<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="index.html">Place Order</a>
            <a href="view.php">View Orders</a>
        </div>
        <h2>Order Status</h2>
        <?php
        require 'config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customer_name = $conn->real_escape_string($_POST['customer_name']);
            $product_name = $conn->real_escape_string($_POST['product_name']);
            $quantity = (int)$_POST['quantity'];
            $total_price = (float)$_POST['total_price'];

            $sql = "INSERT INTO orders (customer_name, product_name, quantity, total_price) 
                    VALUES ('$customer_name', '$product_name', $quantity, $total_price)";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='msg'>Order placed successfully!</p>";
            } else {
                echo "<p class='err'>Error: " . $conn->error . "</p>";
            }
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
