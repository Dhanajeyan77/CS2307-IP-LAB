import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(urlPatterns = {"/DashboardServlet"})
public class DashboardServlet extends HttpServlet {
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        String user = request.getParameter("user");
        String status = request.getParameter("status");
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Dashboard</title>");
            out.println("<style>body{background: lightblue; font-family: Arial; padding: 20px;}</style>");
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Welcome to your Dashboard</h1>");
            
            if (user != null && status != null) {
                out.println("<p><b>Session Verified via URL Rewriting!</b></p>");
                out.println("<p><b>Logged in as: $</b>"+user+"</p>");$
                out.println("<p><b>Current Status $:</b>"+status+"</p>");$
            } else {
                out.println("<p style='color:red;'><b>Error:</b> No active session found!</p>");
            }
            out.println("</body>");
            out.println("</html>");
        }
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        processRequest(request, response);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        processRequest(request, response);
    }
}
