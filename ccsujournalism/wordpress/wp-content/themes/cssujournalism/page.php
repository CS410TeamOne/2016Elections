<?php get_page_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div class="page-header"><h1><?php the_title() ?> </h1> </div>
    <?php the_content(); ?>
    <?php
    wp_link_pages(array(
        'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'ccsujournalism') . '</span>',
        'after' => '</div>',
        'link_before' => '<span>',
        'link_after' => '</span>',
        'pagelink' => '<span class="screen-reader-text">' . __('Page', 'ccsujournalism') . ' </span>%',
        'separator' => '<span class="screen-reader-text">, </span>',
    ));
    ?>

    <?php
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
endwhile;
?>
</div>
<div class="container"></div>
<?php get_footer(); ?>