<?php get_header(); ?>
<div class="container" style="margin-top:0px;">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">

        <?php
        #get the amount of top stories, then output the correct amount
        #of indicators for the carousel.
        #$top_story_count = 
        $a = query_posts('category_name=Top Stories');
	$top_story_count = count($a);
        for ($x = 0; $x < $top_story_count; $x++) {
            if ($x == 0) {
                $class_string = 'class="active"';
            }else{
                $class_string = '';
            }
            $str = "\n<li data-target=\"#myCarousel\" data-slide-to=\"" .$x . "\" " . $class_string . "></li>";
            echo $str;
        }
        ?>
        <!--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>-->
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
                    <img src="<?php echo_first_image(get_the_id()); ?>">
                    <div class="container">
                        <div class="carousel-caption">
                            <div style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">
                                <h1><?php the_title() ?></h1>
                                <p><?php the_excerpt() ?></p>
                            </div>
                            <p><a class="btn btn-lg btn-primary" href="<?php the_permalink() ?>" role="button">Read</a></p>
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
<div class="container">
    <h1>Top Stories</h1>
    <div class="well">
<?php query_posts('category_name=&post_status=publish,future'); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php the_title() ?></h3>
                    </div>
                    <div class="panel-body">
        <?php the_excerpt() ?>
                    </div>
                </div>
        <?php
    endwhile;
else: endif;
?>
    </div>
</div>
</div>
<?php
get_footer();
