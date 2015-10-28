<%-- 
    Document   : signup
    Created on : Oct 28, 2015, Oct 28, 2015 3:13:45 PM
    Author     : johno_000
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sign Up</title>
    </head>
    <body>
        <p:panel header="Register">
            <form method="POST" action="./register">
                Username: <input type="text" name="username" />
                Password: <input type="password" name="password" />
                <br />
                <input type="submit" value="Register" />
                <input type="reset" value="Reset" />
            </form>
        </p:panel>
    </body>
</html>
