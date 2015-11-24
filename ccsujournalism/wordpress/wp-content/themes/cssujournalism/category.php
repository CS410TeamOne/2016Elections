<?php get_header() ?>
<div class='container'>
    <div class='jumbotron'>
        <?php
        $args = array('category' => ID, 'posts_per_page' => 5);
        $myposts = get_posts($args);
        foreach ($myposts as $post) : setup_postdata($post);
            ?>
        <div class='well'><?php the_title() ?></div>
        <?php endforeach; ?>
    </div>
</div>
<?php get_footer() ?>    

