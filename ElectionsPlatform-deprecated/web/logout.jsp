<%-- 
    Document   : logout
    Created on : Nov 9, 2015, Nov 9, 2015 10:08:07 PM
    Author     : John
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Logout</title>
        <meta http-equiv="refresh" content="0; url=./index.jsp" />
    </head>
    <body>
        <% session.invalidate(); %>
    </body>
</html>
