<?php get_header(); ?>


<?php
// Fix menu overlap bug
$str = '';
if (is_admin_bar_showing()) {
    $str = "style='top:95px;'";
}
?>
<?php if (wp_is_mobile()) {
    ?>
    <div class="content-mobile">
        <?php
    } else {
        ?>
        <section class="left-bar" id="sidebar_left" <?php echo $str ?>><?php dynamic_sidebar('left'); ?></section>
        <section class="right-bar" id="sidebar_right" <?php echo $str ?>><?php dynamic_sidebar('right'); ?></section>
        <div class="content">
    <?php
}
?>
        <?php if (!wp_is_mobile()) { ?>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
    <?php
    #get the amount of top stories, then output the correct amount
    #of indicators for the carousel. 
    $a = query_posts('category_name=Top Stories');
    $top_story_count = count($a);
    for ($x = 0; $x < $top_story_count; $x++) {
        if ($x == 0) {
            $class_string = 'class="active"';
        } else {
            $class_string = '';
        }
        $str = "\n<li data-target=\"#myCarousel\" data-slide-to=\"" . $x . "\" " . $class_string . "></li>";
        echo $str;
    }
    ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php
                    #this is a counter for the 'active' css to be placed on the first carousel slide object.
                    #there is probably a better way to do this, but this will work.
                    static $x = 0
                    ?>
                    <?php query_posts('category_name=Top Stories&post_status=publish,future'); ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                            <div class="item <?php
                            if ($x == 0) {
                                echo "active";
                                $x = $x + 1;
                            }
                            ?> ">
                                <img src="<?php echo_first_image(get_the_id()); ?>" alt="ERROR: Failed to get Carousel Image!">
                                <div class="container">
                                    <div class="carousel-caption-wrapper">
                                        <div class="carousel-caption">                                   
                                            <div style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">                                  
                                                <h1><?php the_title() ?> <?php
                if (in_category("videos")) {
                    echo get_video_glyph();
                }
                ?></h1>
                                                <p><?php the_excerpt() ?> |
                                                    <a href='<?php the_permalink(); ?>'>Read More</a></p>           
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
            <?php
        endwhile;
    else: endif;
    ?>
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>
            <hr/>
<?php } ?>
        <!-- Always display new stories and top discussions
        code to display a col-md-6 should probably be written as a function, but this will do for now.
        -->
        <div class="row">
            <div class="col-md-6">
                <h1><span class="glyphicon glyphicon-time"></span> New Posts</h1>
                <table class="table table-striped">
<?php query_posts('category_name=&post_status=publish,future=&posts_per_page=5'); ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <tr><td><a href="<?php the_permalink(); ?>"><?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail(array(100, 100));
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
                            }
                            ?></a></td>
                                <td><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/><?php the_excerpt(); ?>
                                    <?php
                                    if (in_category("videos")) {
                                        echo get_video_glyph();
                                    }
                                    ?>
                                    <span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> 
                                </td></tr>
                            <?php
                        endwhile;
                    else: endif;
                    ?>
                </table>
            </div>
            <div class="col-md-6">
                <h1><span class="glyphicon glyphicon-fire"></span> Top Discussions</h1>
                <table class="table table-striped">
                    <?php $popular = new WP_Query('orderby=comment_count&posts_per_page=5'); ?> 
                                <?php while ($popular->have_posts()) : $popular->the_post(); ?> 
                        <tr><td><a href="<?php the_permalink(); ?>"><?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail(array(100, 100));
                                    } else {
                                        echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
                                    }
                                    ?></a></td>
                            <td><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/><?php the_excerpt(); ?>
                                <?php
                                if (in_category("videos")) {
                                    echo get_video_glyph();
                                }
                                ?>
                                <span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> 
                            </td></tr>
            <?php endwhile; ?>
                </table>
            </div>

            <?php
            if (!wp_is_mobile())
                echo "<div class='row'>";
            $sorted_name_array = get_sorted_cat_arr();
            static $counter = 0;
            foreach ($sorted_name_array as $cat) {
                $category = get_cat_object($cat);
                if ($category->name != 'Uncategorized') {
                    if ($counter % 2 == 0 && !wp_is_mobile()) {
                        echo "</div>";
                        echo "<div class='row'>";
                    }
                    ?>
                    <div class="col-md-6">
                        <a href="./category/<?php echo $category->slug ?>"><h1><span class="glyphicon glyphicon-<?php
                            echo get_category_glyph($category);
                            ?>"></span> <?php echo $category->name ?> </h1></a>
                        <table class="table table-striped table-condensed">
                                        <?php query_posts('category_name=' . $category->name . '&post_status=publish,future=&posts_per_page=5'); ?>
                                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                    <tr><td>
                                            <a href="<?php the_permalink(); ?>"><?php
                                                if (has_post_thumbnail()) {
                                                    the_post_thumbnail(array(100, 100));
                                                } else {
                                                    echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
                                                }
                                                ?></a></td>
                                        <td><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/><?php the_excerpt(); ?>
                                    <?php
                                    if (in_category("videos")) {
                                        echo get_video_glyph();
                                    }
                                    ?>
                                            <span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> 
                                        </td></tr>
                            <?php
                        endwhile;
                    else: endif;
                    ?>
                        </table>
                    </div>
            <?php
            $counter++;
        }
    }
    ?>
<?php if ($counter % 2 != 0 && !wp_is_mobile()) echo "</div>"; ?>
        </div>
    </div>  
    <!--This should be changed... just a quick fix to get the footer to display properly.-->
    <div class="container"></div>
<?php get_footer(); ?>
</body>
</html>
