<?php get_header() ?>
<div class='container'>
    <div class='jumbotron'>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2> <?php the_title() ?></h2>
                <small> <?php the_author() ?> | <?php the_time('F jS, Y') ?></small>
                <hr/>
                <div class='container'>
                    <p> <?php the_content() ?></p>
                </div>
                <hr/>
                <?php comments_template() ?>
                
                <?php
            endwhile;
        else: endif;
        ?>
    </div>
</div>
<?php get_footer() ?>    

