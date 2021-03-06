<?php get_page_header(); ?>
<?php if (!wp_is_mobile()) { ?>
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
                        <img src="<?php
                        get_carousel_image();
                        ?>" alt="ERROR: Failed to get Carousel Image!">
                        <div class="container">
                            <div class="carousel-caption-wrapper">
                                <div class="carousel-caption">                                   
                                    <div style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000; padding-left:2%;">                                  
                                        <h1><?php the_title(); ?> <?php get_media_glyphs(); ?></h1>
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
<?php } ?>
<ul class="nav nav-tabs">
    <?php if (wp_is_mobile()) { ?>
        <li class="active"><a data-toggle="tab" href="#campus">Campus</a></li>
        <li><a data-toggle="tab" href="#community">Community</a></li>
        <li><a data-toggle="tab" href="#state">State</a></li>
        <li><a data-toggle="tab" href="#nation">Nation</a></li>
    <?php } else { ?>
        <li class="active"><a data-toggle="tab" href="#campus"><span class="glyphicon glyphicon-education"></span> Campus</a></li>
        <li><a data-toggle="tab" href="#community"><span class="glyphicon glyphicon-user"></span> Community</a></li>
        <li><a data-toggle="tab" href="#state"><span class="glyphicon glyphicon-tree-conifer"></span> State</a></li>
        <li><a data-toggle="tab" href="#nation"><span class="glyphicon glyphicon-star"></span> Nation</a></li>
    <?php } ?>
</ul>

<div class="tab-content">
    <div id="campus" class="tab-pane fade in active">
        <div class="row">
            <?php show_posts_by_tag("campus", "New Posts", "time", "date"); ?>
            <?php show_posts_by_tag("campus", "Top Discussions", "comment", "comment_count"); ?>
        </div>
    </div>
    <div id="community" class="tab-pane fade">
        <div class="row">
            <?php show_posts_by_tag("community", "New Posts", "time", "date"); ?>
            <?php show_posts_by_tag("community", "Top Discussions", "comment", "comment_count"); ?>
        </div>
    </div>
    <div id="state" class="tab-pane fade">
        <div class="row">
            <?php show_posts_by_tag("state", "New Posts", "time", "date"); ?>
            <?php show_posts_by_tag("state", "Top Discussions", "comment", "comment_count"); ?>
        </div>
    </div>
    <div id="nation" class="tab-pane fade">
        <div class="row">
            <?php show_posts_by_tag("nation", "New Posts", "time", "date"); ?>
            <?php show_posts_by_tag("nation", "Top Discussions", "comment", "comment_count"); ?>
        </div>
    </div>
    <hr/>
</div>
<?php
if (!wp_is_mobile()) {
    echo "<div class='row'>";
}
$sorted_name_array = get_sorted_cat_arr();
static $counter = 0;
foreach ($sorted_name_array as $cat) {
    $category = get_cat_object($cat);
    if ($category->name != 'Uncategorized') {
        if ($counter % 2 == 0 && !wp_is_mobile()) {
            echo "</div>";
            echo "<div class='row'>";
        }
        show_posts($category);
        $counter++;
    }
}
if ($counter % 2 != 0 && !wp_is_mobile()) {
    echo "</div>";
}
?>
</div>
</div>  
<div class="container"></div>
<?php get_footer(); ?>
</body>
</html>
