<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 400px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <h2 style="color: #28a745;">Registration Successful!</h2>
    <h3>Submitted Details:</h3>
    
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Full Name</td>
            <td><%= request.getParameter("uname") %></td>
        </tr>
        <tr>
            <td>Email Address</td>
            <td><%= request.getParameter("email") %></td>
        </tr>
        <tr>
            <td>Age</td>
            <td><%= request.getParameter("age") %></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><%= request.getParameter("gender") %></td>
        </tr>
        <tr>
            <td>Course Enrolled</td>
            <td><%= request.getParameter("course") %></td>
        </tr>
    </table>
    <br>
    <a href="index.html">Go Back</a>
</body>
</html>
