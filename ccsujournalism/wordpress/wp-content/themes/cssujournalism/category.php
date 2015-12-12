<?php
get_header();
?>
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
        <?php } ?>
        <div class="well">
            <?php
            $get_cat = get_query_var('cat');
            $category = get_category($get_cat);
            ?>
            <div class="page-header">
                <h1>
                    <span class="glyphicon glyphicon-<?php echo get_category_glyph($category); ?>"></span> 
                        <?php echo $category->name; ?>
                </h1>
            </div>
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    display_post_collection();
                endwhile;
                the_posts_pagination(array(
                    'prev_text' => __('Previous page', 'ccsujournalism'),
                    'next_text' => __('Next page', 'ccsujournalism'),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'ccsujournalism') . ' </span>',
                ));
            else :
                echo "No results.";
            endif;
            ?>
        </div>
    </div>
</div>