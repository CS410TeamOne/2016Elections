/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import javax.annotation.Resource;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.sql.*;
import java.sql.*;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author johno_000
 */
public class register extends HttpServlet {

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
     * @throws java.security.NoSuchAlgorithmException
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException, NoSuchAlgorithmException {
        String redirect = "/login.jsp";
        String DEFAULT_GROUP = "USER";
        response.setContentType("text/html;charset=UTF-8");
        try{
            String insert = "INSERT INTO USERTABLE(USERNAME,PASSWORD) VALUES (?,?)";
            String add_group = "INSERT INTO GROUPTABLE(USERNAME,GROUPID) VALUES(?,?)";
            try(Connection connect = datasource.getConnection()){
                PreparedStatement adduser = connect.prepareStatement(insert);
                PreparedStatement addgroup = connect.prepareStatement(add_group);
                String username = request.getParameter("username");
                String password = request.getParameter("password");
                MessageDigest hasher = MessageDigest.getInstance("SHA-256");
                hasher.update(password.getBytes("UTF-8"));
                byte[] digest = hasher.digest();
                String hash = String.format("%064x", new java.math.BigInteger(1, digest));
                adduser.setString(1, username);
                addgroup.setString(1, username);
                adduser.setString(2, hash);
                addgroup.setString(2, DEFAULT_GROUP);
                adduser.executeUpdate();
                addgroup.executeUpdate();
            }catch(SQLException ex){
                request.setAttribute("error", ex.getMessage());
                redirect = "/error.jsp";
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
        try {
            processRequest(request, response);
        } catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(register.class.getName()).log(Level.SEVERE, null, ex);
        }
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
        try {
            processRequest(request, response);
        } catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(register.class.getName()).log(Level.SEVERE, null, ex);
        }
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
