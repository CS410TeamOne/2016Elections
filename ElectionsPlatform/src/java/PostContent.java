/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import javax.annotation.Resource;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.sql.DataSource;

/**
 *
 * @author johno_000
 */
public class PostContent extends HttpServlet {

    @Resource(name = "jdbc/elections")
    DataSource datasource;

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String redirect = "./index.html";
        response.setContentType("text/html;charset=UTF-8");
        HttpSession session = request.getSession();
        java.util.Date myDate = new java.util.Date();
        java.sql.Date sqlDate = new java.sql.Date(myDate.getTime());
        try {
            String insert = "INSERT INTO CONTENT(ID,TEXT,TITLE,SUBTITLE,DATETIME,IS_LINK,SUBMITTED_BY) VALUES (?,?,?,?,?,?,?)";
            try (Connection connect = datasource.getConnection()) {
                 PreparedStatement postContent = connect.prepareStatement(insert);
                 postContent.setInt(1,1);
                 postContent.setString(2,(String) session.getAttribute("text"));
                 postContent.setString(3,(String) session.getAttribute("title"));
                 postContent.setString(4,(String) session.getAttribute("subtitle"));
                 postContent.setDate(5, sqlDate);
                 postContent.setBoolean(6, false);
                 postContent.setString(7,(String) session.getAttribute("j_username"));
                 postContent.executeUpdate();
            } catch (SQLException ex) {
                request.setAttribute("error", ex.getMessage());
                redirect = "./error.jsp";
            }
        } finally {
            //request.getRequestDispatcher(redirect).forward(request, response);
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
