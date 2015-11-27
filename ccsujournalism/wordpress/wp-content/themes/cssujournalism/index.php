<?php get_header(); ?>


<?php
// Fix menu overlap bug
$str = '';
if (is_admin_bar_showing()) {
    $str = "style='top:95px;'";
}
?>
<?php if (wp_is_mobile() )
{?>
<div class="content-mobile">
<?php
}
else
{
?>
<section class="left-bar" id="sidebar_left" <?php echo $str ?>><?php get_sidebar('left'); ?></section>
<section class="right-bar" id="sidebar" <?php echo $str ?>><?php get_sidebar('right'); ?></section>
<div class="content">
<?php
}
?>


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
                                        <h1><?php the_title() ?></h1>
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
    <!-- Always display new stories and top discussions
    code to display a col-md-6 should probably be written as a function, but this will do for now.
    -->
    <div class="row">
        <div class="col-md-6">
            <a href="./category.php"><h1><span class="glyphicon glyphicon-time"></span> New Posts</h1></a>
            <table class="table table-striped">
                <?php query_posts('category_name=&post_status=publish,future=&posts_per_page=5'); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <tr><td><?php  if(has_post_thumbnail()){
                                the_post_thumbnail(array(100,100)); 
                                }else{
                                    echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
                                }?></td>
                                    <td><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/><?php the_excerpt(); ?>
                                    <?php if(in_category("videos")){
                                    echo get_video_glyph();
                                    }?>
                                    <span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> 
                                </td></tr>
                        <?php
                    endwhile;
                else: endif;
                ?>
            </table>
        </div>
        <div class="col-md-6">
            <a href="./category.php"><h1><span class="glyphicon glyphicon-fire"></span> Top Discussions</h1></a>
            <table class="table table-striped">
                <?php $popular = new WP_Query('orderby=comment_count&posts_per_page=5'); ?> 
                <?php while ($popular->have_posts()) : $popular->the_post(); ?> 
                    <tr><td><?php  if(has_post_thumbnail()){
                                the_post_thumbnail(array(100,100)); 
                                }else{
                                    echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
                                }?></td>
                                    <td><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/><?php the_excerpt(); ?>
                                    <?php if(in_category("videos")){
                                    echo get_video_glyph();
                                    }?>
                                    <span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> 
                                </td></tr>
                <?php endwhile; ?>
            </table>
        </div> 
</div>        
        <?php
        $category_array = get_category_array();
        foreach ($category_array as $category) {
            if ($category->name != 'Uncategorized') {
                ?>
                <div class="col-md-6">
                    <a href="./category.php"><h1><span class="glyphicon glyphicon-<?php
                            $default_glyph = "th-list";
                            #this is probably awful and inefficent but hey whats a few loops among friends
                            $custom_terms = get_terms("category");
                            foreach ($custom_terms as $term) {
                                if ($term->name == $category->name) {

                                    $src = get_tax_meta($term->term_id, 'glyphicon');
                                    if($src==""){
                                        echo $default_glyph;
                                    }
                                    echo $src;
                                }
                            }
                            ?>"></span> <?php echo $category->name ?> </h1></a>
                    <table class="table table-striped table-condensed">
                        <?php query_posts('category_name=' . $category->name . '&post_status=publish,future=&posts_per_page=5'); ?>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <tr><td>
                                <?php  if(has_post_thumbnail()){
                                the_post_thumbnail(array(100,100)); 
                                }else{
                                    echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
                                }?></td>
                                    <td><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/><?php the_excerpt(); ?>
                                    <?php if(in_category("videos")){
                                    echo get_video_glyph();
                                    }?>
                                    <span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> 
                                </td></tr>
                                <?php
                            endwhile;
                        else: endif;
                        ?>
                    </table>
                </div>

            <?php }
        } ?>
        </div>
    <!--This should be changed... just a quick fix to get the footer to display properly.-->
    <div class="container"></div>
<?php
get_footer();
