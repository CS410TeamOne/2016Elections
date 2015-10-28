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
    </head>
    <body>
        <H1>Login</H1>
         <p:panel header="Login Form">
            <form method="POST" action="j_security_check">
                Username: <input type="text" name="j_username" />
                Password: <input type="password" name="j_password" />
                <br />
                <input type="submit" value="Login" />
                <input type="reset" value="Reset" />
            </form>
        </p:panel>
    </body>
</html>
