<?php get_header(); ?>

<div id="fb-root"></div>

<section class="left-bar" id="sidebar_left"><?php get_sidebar('left'); ?></section>
<div class="content">
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
    <div class="row">
	<?php
	#This needs to be re-written at some point so it can be done recursively on any category_name
	#that is defined by the user.
	?>
        <div class="col-md-6">
            <h1><span class="glyphicon glyphicon-asterisk"></span> New Posts</h1>
            <table class="table table-striped">
                <?php query_posts('category_name=&post_status=publish,future=&posts_per_page=5'); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <tr><td><span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> </span></td>
                            <td><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?> | <?php the_excerpt(); ?></strong></a></td></tr>
                        <?php
                    endwhile;
                else: endif;
                ?>
            </table>
        </div>
        <div class="col-md-6">
            <h1><span class="glyphicon glyphicon-comment"></span> Opinion</h1>
            <table class="table table-striped">
                <?php query_posts('category_name=Opinion&post_status=publish,future&posts_per_page=5'); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <tr><td><span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> </span></td>
                            <td><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?> | <?php the_excerpt(); ?></strong></a></td></tr>
                        <?php
                    endwhile;
                else: endif;
                ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1><span class="glyphicon glyphicon-flag"></span> Elections Coverage</h1>
            <table class="table table-striped">
                <?php query_posts('category_name=Elections&post_status=publish,future&posts_per_page=5'); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <tr>
                        <tr><td><span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> </span></td>
                            <td><strong>
                                    <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> | <?php the_excerpt(); ?>
                                </strong></a></td></tr>
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
                    <tr><td><span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> </span></td>
                        <td><b><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></b></td></tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1><span class="glyphicon glyphicon-time"></span> Recent Posts</h1>
            <table class="table table-striped">
                <?php
                $args = array('numberposts' => '5');
                $recent_posts = wp_get_recent_posts($args);
                foreach ($recent_posts as $recent) {
                    echo '<tr><td><span class="badge"><span class="glyphicon glyphicon-comment"> </span> ' . get_comments_number() . '</span></td><td><strong><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"] . '</strong></td> </tr> ';
                }
                ?>
            </table>
        </div>
        <div class="col-md-6">
            <h1><span class="glyphicon glyphicon-user"></span> Community Voices</h1>
            <table class="table table-striped">
                <?php query_posts('category_name=Community Voices&post_status=publish,future&posts_per_page=5'); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <tr><td><span class="badge"><span class="glyphicon glyphicon-comment"></span> <?php echo get_comments_number() ?> </span></td>
                            <td><strong><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> | <?php the_excerpt(); ?></strong></a></td></tr>
                        <?php
                    endwhile;
                else: endif;
                ?>
            </table>
        </div>
    </div>
</div>
</div>
<section class="right-bar" id="sidebar"><?php get_sidebar('right'); ?></section>

<?php
get_footer();
