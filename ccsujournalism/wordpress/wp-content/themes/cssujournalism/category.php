<?php
/**
* A Simple Category Template
*/

get_header(); ?>
<?php if (wp_is_mobile() )
{?>
<div class="content-mobile">
<?php
}
else
{
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
  $category= get_category ($get_cat);
?>
<div class="page-header"><h1><span class="glyphicon glyphicon-<?php
                            echo get_category_glyph($category);
                            ?>"></span> <?php echo $category->name;?></h1></div>
<div class="row">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-6">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
            <hr/>
                <?php the_excerpt(); ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Sorry, no posts matched your criteria.</p>
    <?php endif; ?>
    </div>
</div>
</div>