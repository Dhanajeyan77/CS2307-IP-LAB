<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="index.html">Place Order</a>
            <a href="view.php">View Orders</a>
        </div>
        <h2>Order History</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
            <?php
            require 'config.php';
            $result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
            
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . htmlspecialchars($row["customer_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["product_name"]) . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>$" . number_format($row["total_price"], 2) . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No orders found.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
