<?php
/**
 * A Simple Category Template
 */
get_header();
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
        <div class="well">
        <?php
        $get_cat = get_query_var('cat');
        $category = get_category($get_cat);
        ?>
            <div class="page-header"><h1><span class="glyphicon glyphicon-<?php
            echo get_category_glyph($category);
            ?>"></span> <?php echo $category->name; ?></h1></div>
            
                    <?php if (have_posts()) : ?>
                                                   <?php while (have_posts()) : the_post(); ?>
                                                   <table class="table table-striped table-condensed">
            <tr><td>
                            <h2><?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail(array(100, 100));
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
                            }?>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); 
                            if (in_category("videos") || has_tag("video")){
														echo get_glyph("video");
													}
													if(in_category("audio") || has_tag("audio")){
														echo get_glyph("audio");
													}
													if(in_category("images") || has_tag("images") || has_tag ("image") || has_tag("gallery")){
														echo get_glyph("gallery");
													}?></a></h2>
                                                    </tr></td><tr><td>
                            <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
                            <hr/>
        <?php the_excerpt(); ?>
                        
                        </tr></td>
                        </table>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <p>Sorry, no posts matched your criteria.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>