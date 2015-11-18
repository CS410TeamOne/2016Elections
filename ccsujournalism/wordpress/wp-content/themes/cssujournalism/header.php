<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyfifteen' ); ?></a>

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
        </nav><!-- .site-header -->
</div>
