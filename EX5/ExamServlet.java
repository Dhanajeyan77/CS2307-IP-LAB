

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.io.PrintWriter;

@WebServlet("/ExamServlet")

public class ExamServlet extends HttpServlet {

    @Override
    protected void doPost(
            HttpServletRequest request,
            HttpServletResponse response)
            throws ServletException, IOException {

        String name =
                request.getParameter("studentName");

        String[] correct = {
            "b", "a", "a", "a", "a",
            "a", "b", "a", "a", "b"
        };

        int score = 0;

        for (int i = 1; i <= 10; i++) {

            String answer =
                    request.getParameter("q" + i);

            if (answer != null &&
                    answer.equals(correct[i - 1])) {

                score++;
            }
        }

        response.setContentType("text/html");

        PrintWriter out =
                response.getWriter();

        out.println("<html>");

        out.println("<head>");
        out.println("<title>Quiz Result</title>");
        out.println("</head>");

        out.println("<body>");

        out.println("<h1>Quiz Result</h1>");

        out.println("<h2>Student: "
                + name + "</h2>");

        out.println("<h2>Score: "
                + score + " / 10</h2>");

        out.println("</body>");

        out.println("</html>");
    }
}