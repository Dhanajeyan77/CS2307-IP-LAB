<%@ page import="java.sql.*" %>
<%@ page contentType="text/html; charset=UTF-8" %>
<!DOCTYPE html>
<html>
<head>
    <title>Order Processing Status</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 600px; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #343a40; color: white; }
        .success { color: #28a745; }
        .error { color: #dc3545; }
    </style>
</head>
<body>
    <h2>Order Status</h2>
    
    <%
        String customerName = request.getParameter("customerName");
        String productName = request.getParameter("productName");
        String quantity = request.getParameter("quantity");
        String price = request.getParameter("price");

        Connection conn = null;
        PreparedStatement pstmt = null;
        ResultSet rs = null;

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/shop_db", "root", "Thala@2007");

            String insertSql = "INSERT INTO orders (customer_name, product_name, quantity, total_price) VALUES (?, ?, ?, ?)";
            pstmt = conn.prepareStatement(insertSql);
            pstmt.setString(1, customerName);
            pstmt.setString(2, productName);
            pstmt.setInt(3, Integer.parseInt(quantity));
            pstmt.setDouble(4, Double.parseDouble(price));
            
            int rows = pstmt.executeUpdate();
            if(rows > 0) {
                out.println("<h3 class='success'>✅ Order placed successfully in the database!</h3>");
            }

            out.println("<h3>Order Database Records:</h3>");
            out.println("<table><tr><th>Order ID</th><th>Customer Name</th><th>Product</th><th>Quantity</th><th>Total Price</th></tr>");
            
            Statement stmt = conn.createStatement();
            rs = stmt.executeQuery("SELECT * FROM orders ORDER BY order_id DESC");
            
            while(rs.next()) {
                out.println("<tr>");
                out.println("<td>" + rs.getInt("order_id") + "</td>");
                out.println("<td>" + rs.getString("customer_name") + "</td>");
                out.println("<td>" + rs.getString("product_name") + "</td>");
                out.println("<td>" + rs.getInt("quantity") + "</td>");
                out.println("<td>₹" + rs.getDouble("total_price") + "</td>");
                out.println("</tr>");
            }
            out.println("</table>");

        } catch(Exception e) {
            out.println("<h3 class='error'>Database Error: " + e.getMessage() + "</h3>");
        } finally {
            if(rs != null) rs.close();
            if(pstmt != null) pstmt.close();
            if(conn != null) conn.close();
        }
    %>
    <br><br>
    <a href="index.html" style="padding: 10px; background: #007bff; color: white; text-decoration: none;">Place Another Order</a>
</body>
</html>
