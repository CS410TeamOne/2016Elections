<?php get_page_header(); ?>
<div class="well">

    <?php if (have_posts()) : ?>

        <h1 class="page-title"><?php printf(__('Search Results for: %s', 'ccsujournalism'), get_search_query()); ?></h1>
        <hr/>

        <?php
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
<?php
get_footer();
