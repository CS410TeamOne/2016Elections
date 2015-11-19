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
        <title>Journalism@CCSU</title>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!--[if lt IE 9]>
        <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
        <![endif]-->
        <!--StyleSheets-->
        <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
        <?php wp_enqueue_script("jquery"); ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <nav class="navbar navbar-default navbar-fixed-top">
            <?php
            // Fix menu overlap bug..
            if (is_admin_bar_showing())
                echo '<div style="min-height: 28px;"></div>';
            ?>
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="/map/">Map</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=register">Register</a></li>
                        <li><a href="<?php bloginfo('wpurl'); ?>/wp-login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- .site-header -->
