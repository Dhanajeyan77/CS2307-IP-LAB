import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(urlPatterns = {"/NewServlet"})
public class NewServlet extends HttpServlet {
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        String name = request.getParameter("n");
        String password = request.getParameter("p");
        String status = request.getParameter("sessionStatus");
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<html>");
            out.println("<head>");
            out.println("<style>body{background:lightblue; font-family: Arial; padding: 20px;}</style>");
            out.println("</head>");
            out.println("<body>");
            out.println("<h2>Login Successful</h2>");
            out.println("<p><b>Username:</b> " + name + "</p>");
            out.println("<p><b>Password:</b> " + password + "</p>");
            out.println("<p><b>Hidden Session Status:</b> " + status + "</p>");
            String rewrittenUrl = "DashboardServlet?user=" + name + "&status=" + status;
            out.println("<br><br>");
            out.println("<a href=''" + rewrittenUrl + "'>Proceed to Dashboard (URL Rewriting Link)</a>");
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
    
    @Override
    public String getServletInfo() {
        return "Servlet with Hidden Form Field and URL Rewriting Session Tracking";
    }
}
