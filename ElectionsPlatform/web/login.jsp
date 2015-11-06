<%-- 
    Document   : login
    Created on : Oct 26, 2015, Oct 26, 2015 4:53:15 PM
    Author     : johno_000
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
         <% session.invalidate(); %>
        <div id="wrapper">
            <div id="header-wrapper">
                <div id="header" class="container">
                    <div id="logo">
                        <h1><a href="#">CCSU Journalism</a></h1>
                    </div>
                    <div id="menu">
                        <ul>
                            <li><a href="./index.jsp" title="">Home</a></li>
                            <li><a href="#" title="">Map</a></li>
                            <li class="current_page_item"><a href="./login.jsp" title="">Login</a></li>
                            <li><a href="./signup.jsp" title="">Register</a></li>        
                        </ul>
                    </div>
                </div>
            </div>
            <div id="bigstory">
                <form method="POST" action="j_security_check">
                    Username: <input type="text" name="j_username" /><br/>
                    Password: <input type="password" name="j_password" />
                    <br />
                    <input type="submit" value="Login" />
                    <input type="reset" value="Reset" />
                </form>
            </div>
        </div>
    </body>
</html>
