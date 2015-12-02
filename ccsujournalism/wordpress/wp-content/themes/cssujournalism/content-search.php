<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <blockquote>
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?><!-- .entry-header -->

        <?php the_excerpt(); ?>

        <?php if ('post' == get_post_type()) : ?>
            <?php edit_post_link(__('Edit', 'ccsujournalism'), '<hr/>', ''); ?>
        <?php else : ?>

            <?php edit_post_link(__('Edit', 'ccsujournalism'), '<hr/>', ''); ?>

        <?php endif; ?>
    </blockquote>
</article><!-- #post-## -->
