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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
        <Title>Register</title>
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
				<li><a href="./" title="">Home</a></li>
				<li><a href="#" title="">Map</a></li>
				<li><a href="./login.jsp" title="">Login</a></li>
				<li class="current_page_item"><a href="./signup.jsp" title="">Register</a></li>        
			</ul>
		</div>
	</div>
        </div>
             <div id="bigstory">
            <form method="POST" action="./register">
                Username: <input type="text" name="username"/> <br/>
                Password: <input type="password" name="password" />
                <br />
                <input type="submit" value="Register" />
                <input type="reset" value="Reset" />
            </form>
             </div>
        </div>
             
    </body>
</html>
