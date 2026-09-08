package com.mycompany.mavenproject3;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

public class TrainDAO {

    private static final String URL =
            "jdbc:mysql://localhost:3306/train_booking";

    private static final String USER =
            "trainapp";

    private static final String PASSWORD =
            "train123";


    public boolean saveBooking(
            int trainNo,
            int seatCount,
            String transactionId,
            double total) {

        String sql =
                "INSERT INTO bookings "
                + "(train_no, seat_count, transaction_id, total) "
                + "VALUES (?, ?, ?, ?)";

        try {

            Class.forName(
                    "com.mysql.cj.jdbc.Driver");

            Connection con =
                    DriverManager.getConnection(
                            URL, USER, PASSWORD);

            PreparedStatement ps =
                    con.prepareStatement(sql);

            ps.setInt(1, trainNo);

            ps.setInt(2, seatCount);

            ps.setString(3, transactionId);

            ps.setDouble(4, total);

            int result =
                    ps.executeUpdate();

            ps.close();

            con.close();

            return result > 0;

        } catch (Exception e) {

            e.printStackTrace();

            return false;
        }
    }


    public String getAllBookingsRows() {

        StringBuilder rows =
                new StringBuilder();

        String sql =
                "SELECT * FROM bookings";

        try {

            Class.forName(
                    "com.mysql.cj.jdbc.Driver");

            Connection con =
                    DriverManager.getConnection(
                            URL, USER, PASSWORD);

            PreparedStatement ps =
                    con.prepareStatement(sql);

            ResultSet rs =
                    ps.executeQuery();

            while (rs.next()) {

                rows.append("<tr>")

                    .append("<td>")
                    .append(rs.getInt("train_no"))
                    .append("</td>")

                    .append("<td>")
                    .append(rs.getInt("seat_count"))
                    .append("</td>")

                    .append("<td>")
                    .append(rs.getString("transaction_id"))
                    .append("</td>")

                    .append("<td>")
                    .append(rs.getDouble("total"))
                    .append("</td>")

                    .append("</tr>");
            }

            rs.close();

            ps.close();

            con.close();

        } catch (Exception e) {

            e.printStackTrace();

            return "<tr>"
                    + "<td colspan='4'>"
                    + "Error loading table data"
                    + "</td>"
                    + "</tr>";
        }

        return rows.toString();
    }
}