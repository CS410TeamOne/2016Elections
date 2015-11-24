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
            // Fix menu overlap bug
            if (is_admin_bar_showing())
                echo '<div style="min-height: 28px;"></div>';
            ?>
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list"></span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php
                                $args = array(
                                    'show_option_all' => '',
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'style' => 'list',
                                    'show_count' => 0,
                                    'hide_empty' => 0,
                                    'use_desc_for_title' => 1,
                                    'child_of' => 0,
                                    'feed' => '',
                                    'feed_type' => '',
                                    'feed_image' => '',
                                    'exclude' => '',
                                    'exclude_tree' => '',
                                    'include' => '',
                                    'hierarchical' => 1,
                                    'title_li' => __(''),
                                    'show_option_none' => __(''),
                                    'number' => null,
                                    'echo' => 1,
                                    'depth' => 0,
                                    'current_category' => 0,
                                    'pad_counts' => 0,
                                    'taxonomy' => 'category',
                                    'walker' => null
                                );
                                wp_list_categories($args);
                                ?>
                            </ul>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <?php
                        if (is_user_logged_in()){
                            global $current_user;
                            get_currentuserinfo();
                        }
                        if (current_user_can('read')) {
                            echo "<li><a href=\"" . site_url() . "/wp-admin\"> <span class='glyphicon glyphicon-cog'></span>  " . $current_user->display_name . "</a></li>";
                        }
                        else {
                            echo "<li><a href=\"" . site_url() . "/wp-login.php?action=register\">Register</a></li>";
                            echo "<li><a href=\"" . site_url() . "/wp-login.php\">Login</a></li>";
                        }
                        ?>
                    </ul>
                </div>
        </nav>
        <!-- .site-header -->
