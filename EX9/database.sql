CREATE DATABASE IF NOT EXISTS shop_db;
USE shop_db;

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL
);
