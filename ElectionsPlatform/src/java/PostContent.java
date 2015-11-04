/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
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
        String redirect = "./postContent.jsp";
        response.setContentType("text/html;charset=UTF-8");
        HttpSession session = request.getSession();
        java.util.Date myDate = new java.util.Date();
        java.sql.Date sqlDate = new java.sql.Date(myDate.getTime());
        String error = "";
        String text = (String)request.getParameter("text");
        String title = (String)request.getParameter("title");
        String subtitle = (String)request.getParameter("subtitle");
        String username = (String) request.getParameter("j_username");
        boolean link = false;
        if(request.getParameter("is_link")!=null){
            link = true;
        }
        try {
            String insert = "INSERT INTO CONTENT(TEXT,TITLE,SUBTITLE,DATETIME,IS_LINK,SUBMITTED_BY) VALUES (?,?,?,?,?,?)";

            try (Connection connect = datasource.getConnection()) {
                 PreparedStatement postContent = connect.prepareStatement(insert);
                 postContent.setString(1,text);
                 postContent.setString(2,title);
                 postContent.setString(3,subtitle);
                 postContent.setDate(4, sqlDate);
                 postContent.setBoolean(5, link);
                 postContent.setString(6,username);
                 postContent.executeUpdate();
            } catch (SQLException ex) {
                error = ex.getMessage();
                request.setAttribute("error", ex.getMessage());
                redirect = "../error";
            }
        } finally {
            request.getRequestDispatcher(redirect).forward(request,response);
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
