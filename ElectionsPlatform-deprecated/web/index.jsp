<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CCSU Journalism Web Platform</title>
        <link href="css/carousel.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <%
            if (session.getAttribute("username") != null) {
                session.setAttribute("loggedin", true);
                String user_class = (String) session.getAttribute("class");
                if (user_class.equals("admin")) {
                    session.setAttribute("admin", true);
                }
            }
        %>
        <!-- NAV bar-->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/index.jsp">CCSU Journalism</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="/map.jsp">Map</a></li>
                        <c:if test="${admin}"><li><a href="./admin/postContent.jsp">Post</a></li></c:if>
                        </ul>
                        <ul class="nav navbar-nav pull-right">
                        <c:choose>
                            <c:when test="${loggedin}">
                                <li><a href="" data-toggle="modal" data-target="#register">User Management</a></li>
                                <li><a href="./logout.jsp">Logout</a></li>
                                </c:when>
                                <c:otherwise>
                                <li><a href="" data-toggle="modal" data-target="#register">Register</a></li>
                                <li><a href="" data-toggle="modal" data-target="#signIn">Login</a></li>
                                </c:otherwise>
                            </c:choose>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End NAV -->
        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Example headline.</h1>
                            <p>Some information regarding the headline goes here.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>One more for good measure.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- END CAROUSEL -->
        <!--Display Body-->
        <div class="container">
            <div class="row">
                <!--Story Colum-->
                <div class="col-sm-4">
                    <h1>Stories</h1>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Story Title</h3>
                        </div>
                        <div class="panel-body">
                            Article text goes here
                        </div>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Story 2 Title</h3>
                        </div>
                        <div class="panel-body">
                            Article text goes here
                        </div>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Story 3 title</h3>
                        </div>
                        <div class="panel-body">
                            Article text goes here
                        </div>
                    </div>
                </div>
                <!--End story column-->
                <!--Links Column-->
                <div class="col-sm-4">
                    <h1>Links</h1>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <a href=""><h3 class="panel-title">URL Name Here</h3></a>
                        </div>
                        <div class="panel-body">
                            Description here
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <a href=""><h3 class="panel-title">URL Name Here</h3></a>
                        </div>
                        <div class="panel-body">
                            Description here
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <a href=""><h3 class="panel-title">URL Name Here</h3></a>
                        </div>
                        <div class="panel-body">
                            Description here
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--Register/Signin Popups -->
        <!--SIGNIN-->
        <div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login</h4>
                    </div>
                    <div class="modal-body">
                        <form  class="form-signin" method="POST" action="j_security_check">
                            <h2 class="form-signin-heading">Please sign in</h2>
                            <label for="inputUserName" class="sr-only">Username</label>
                            <input type="username" id="inputUserName" class="form-control" placeholder="Username" required autofocus name="j_username">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="j_password">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--REGISTER-->
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Register</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" action="./register" method="POST">
                            <h2 class="form-signin-heading">Please Register</h2>
                            <label for="inputEmail" class="sr-only">EMail</label>
                            <input type="email" id="inputUserName" class="form-control" placeholder="E-Mail" required autofocus name="email">
                            <label for="inputUserName" class="sr-only">Username</label>
                            <input type="username" id="inputUserName" class="form-control" placeholder="Username" required autofocus name="username">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Regsiter</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>
