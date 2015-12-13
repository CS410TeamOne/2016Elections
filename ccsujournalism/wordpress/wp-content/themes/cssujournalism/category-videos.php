<?php get_header(); ?>
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
    <?php
}
?>
<div class="page-header"></div>

        <!-- Always display new stories and top discussions
        code to display a col-md-6 should probably be written as a function, but this will do for now. -->
          <!-- tab setup -->
        <ul class="nav nav-tabs">
        <?php if(wp_is_mobile()){ ?>
  <li class="active"><a data-toggle="tab" href="#campus">Campus</a></li>
  <li><a data-toggle="tab" href="#community">Community</a></li>
  <li><a data-toggle="tab" href="#state">State</a></li>
  <li><a data-toggle="tab" href="#nation">Nation</a></li>
        <?php }else{ ?>
        <li class="active"><a data-toggle="tab" href="#campus"><span class="glyphicon glyphicon-education"></span> Campus</a></li>
  <li><a data-toggle="tab" href="#community"><span class="glyphicon glyphicon-user"></span> Community</a></li>
  <li><a data-toggle="tab" href="#state"><span class="glyphicon glyphicon-tree-conifer"></span> State</a></li>
  <li><a data-toggle="tab" href="#nation"><span class="glyphicon glyphicon-star"></span> Nation</a></li>
        <?php } ?>
</ul>

          <!--displays fade ans stuff on tab change -->
<div class="tab-content">
  <div id="campus" class="tab-pane fade in active">
    <div class="row">
        <!-- <?php show_posts_by_tag("campus", "New Posts", "time", "date"); ?>
        <?php show_posts_by_tag("campus", "Top Discussions", "comment", "comment_count"); ?> -->
    </div>
  </div>
  <div id="community" class="tab-pane fade">
  <div class="row">
    <!--<?php show_posts_by_tag("community", "New Posts", "time", "date"); ?>
    <?php show_posts_by_tag("community", "Top Discussions", "comment", "comment_count"); ?>-->
    </div>
  </div>
  <div id="state" class="tab-pane fade">
  <div class="row">
    <!--<?php show_posts_by_tag("state", "New Posts", "time", "date"); ?>
    <?php show_posts_by_tag("state", "Top Discussions", "comment", "comment_count"); ?>-->
    </div>
  </div>
  <div id="nation" class="tab-pane fade">
  <div class="row">
    <!--<?php show_posts_by_tag("nation", "New Posts", "time", "date"); ?>
    <?php show_posts_by_tag("nation", "Top Discussions", "comment", "comment_count"); ?>-->
    </div>
  </div>
  <hr/>
</div>
<?php
	echo "<div class='row'>";
    $sorted_name_array = get_sorted_cat_arr();
    static $counter = 0;
    //foreach ($sorted_name_array as $cat) {
        $category = get_cat_object("Videos");
        //$category = "Videos"; //sets catergory
        if ($category->name != 'Uncategorized') {
            if ($counter % 2 == 0 && !wp_is_mobile()) {
                echo "</div>";
                echo "<div class='row'>";
            }
			//show_posts($category);
      show_video_posts($category); //places stories
			$counter++;
		//}
	}
	//if ($counter % 2 != 0 && !wp_is_mobile()) echo "</div>"; 
?>
        </div>
    </div>  
    <!--This should be changed... just a quick fix to get the footer to display properly.-->
    <div class="container"></div>
</div>

<?php get_footer(); ?>