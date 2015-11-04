<%-- 
    Document   : postContent
    Created on : Nov 3, 2015, Nov 3, 2015 4:24:49 PM
    Author     : johno_000
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../style.css" />
        <script src="../tinymce/js/tinymce/tinymce.min.js"></script>
        <script typ="text/javscript">tinymce.init({selector: '#tinyMCE'});</script>
        <title>Post Content</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-wrapper">
                <div id="header" class="container">
                    <div id="logo">
                        <h1><a href="#">CCSU Journalism</a></h1>
                    </div>
                    <div id="menu">
                        <ul>
                            <li><a href="../index.html" title="">Home</a></li>
                            <li><a href="#" title="">Map</a></li>
                            <li><a href="../login.jsp" title="">Login</a></li>
                            <li><a href="../signup.jsp" title="">Register</a></li>
                            <li class="current_page_item"><a href="./postContent.jsp" title="">Post</a></li>  
                        </ul>
                    </div>
                </div>
            </div>
            <div id="bigstory">
                <form method="POST" action="PostContent">
                    Title: <input type="text" name="title"/><br/>
                    Text: <input type="textarea" name="text" id="tinyMCE"/><br/>
                    Sub-Title/URL: <input type="textarea" name="subtitle"/><br/>
                    Link Only: <input type="checkbox" name="is_link"/><br/>
                    <input type="submit" value="Post" />
                    <input type="reset" value="Reset" />
                </form>
            </div>
        </div>
    </body>
</html>
