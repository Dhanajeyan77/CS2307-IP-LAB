package com.mycompany.mavenproject3;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;

import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


@WebServlet("/TrainServlet")

public class TrainServlet
        extends HttpServlet {

    @Override

    protected void doPost(
            HttpServletRequest request,
            HttpServletResponse response)

            throws ServletException, IOException {

        int trainNo =
                Integer.parseInt(
                        request.getParameter(
                                "trainNo"));

        int seatCount =
                Integer.parseInt(
                        request.getParameter(
                                "seatCount"));

        String transactionId =
                request.getParameter(
                        "transactionId");

        double total =
                Double.parseDouble(
                        request.getParameter(
                                "total"));


        TrainDAO dao =
                new TrainDAO();


        boolean success =
                dao.saveBooking(
                        trainNo,
                        seatCount,
                        transactionId,
                        total);


        response.setContentType(
                "text/html;charset=UTF-8");


        PrintWriter out =
                response.getWriter();


        out.println(
                "<!DOCTYPE html>"
                + "<html>"
                + "<head>"
                + "<title>"
                + "Train Booking Result"
                + "</title>"
                + "<style>"
        );

        out.println(
                "body {"
                + "background-color: rgb(24,122,179);"
                + "font-family: Arial;"
                + "text-align: center;"
                + "}"
        );

        out.println(
                ".box {"
                + "background-color: white;"
                + "width: 650px;"
                + "margin: 50px auto;"
                + "padding: 30px;"
                + "border-radius: 10px;"
                + "box-shadow: 0px 0px 10px "
                + "rgba(0,0,0,0.1);"
                + "}"
        );

        out.println(
                "h1 { color: green; }"

                + "table {"
                + "width: 100%;"
                + "border-collapse: collapse;"
                + "margin-top: 20px;"
                + "}"

                + "th, td {"
                + "border: 1px solid #ddd;"
                + "padding: 10px;"
                + "text-align: left;"
                + "}"

                + "th {"
                + "background-color: #f2f2f2;"
                + "}"
        );

        out.println(
                "</style>"
                + "</head>"
                + "<body>"
                + "<div class='box'>"
        );


        if (success) {

            out.println(
                    "<h1>Booking Successful</h1>"
            );

            out.println(
                    "<h3>Train Number: "
                    + trainNo
                    + "</h3>"
            );

            out.println(
                    "<h3>Seat Count: "
                    + seatCount
                    + "</h3>"
            );

            out.println(
                    "<h3>Transaction ID: "
                    + transactionId
                    + "</h3>"
            );

            out.println(
                    "<h3>Total Amount: "
                    + total
                    + "</h3>"
            );

            out.println(
                    "<hr style='border: 0.5px solid #ddd;"
                    + " margin: 30px 0;'>"

                    + "<h2>All Current Bookings</h2>"

                    + "<table>"
            );

            out.println(
                    "<tr>"
                    + "<th>Train No</th>"
                    + "<th>Seats</th>"
                    + "<th>Transaction ID</th>"
                    + "<th>Total</th>"
                    + "</tr>"
            );

            out.println(
                    dao.getAllBookingsRows()
            );

            out.println(
                    "</table>"
            );

        } else {

            out.println(
                    "<h1 style='color:red;'>"
                    + "Booking Failed"
                    + "</h1>"

                    + "<p>"
                    + "Unable to save booking."
                    + "</p>"
            );
        }


        out.println(
                "<br><br>"

                + "<a href='train.html'>"
                + "Back to Train Booking"
                + "</a>"

                + "</div>"
                + "</body>"
                + "</html>"
        );
    }
}