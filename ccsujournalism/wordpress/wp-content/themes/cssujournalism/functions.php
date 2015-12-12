<?php
//Add thumbnail support
add_theme_support('post-thumbnails');
require_once("tax-meta-class/Tax-meta-class.php");
require_once('custom-options.php');
$config = array(
    'id' => 'glyph',
    'title' => 'Glyphicons',
    'pages' => array('category'),
    'context' => 'normal',
    'fields' => array(),
    'local_images' => false,
    'use_with_theme' => true
);
$my_meta = new Tax_Meta_Class($config);
//text field
$my_meta->addText('glyphicon', array('name' => 'Glyphicon'));
//textarea field
$my_meta->Finish();

//Enable bootstrap with jquery
function wpbootstrap_scripts_with_jquery() {
    wp_register_script('custom-script', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
    wp_enqueue_script('custom-script');
}

add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery');

//Code to display comments. Called in comments.php using the &callback= function.
function display_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    if (wp_is_mobile()) {
        echo "<div class=\"well well-sm\">";
    } else {
        echo "<blockquote>";
    }
    ?>
    <?php printf(__('%s'), get_comment_author_link()) ?>
    | <a class="comment-permalink" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s'), get_comment_date(), get_comment_time()) ?></a> | 
    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    <hr/>
    <?php if ($comment->comment_approved == '0') : ?>
        <em><?php echo "Your comment is awaiting moderation."; ?></em><br/>
    <?php endif; ?>
    <p>
        <?php comment_text(); ?>
    </p>
    <?php
    if (wp_is_mobile()) {
        echo "</div>";
    } else {
        echo "</blockquote>";
    }
}

//Custom sidebars
function custom_sidebars() {

    $sidebar_left = array(
        'id' => 'left',
        'class' => 'sidebar',
        'name' => __('sidebar-left', 'text_domain'),
        'description' => __('Sidebar for the lefthand side of the screen', 'text_domain'),
    );
    $sidebar_right = array(
        'id' => 'right',
        'class' => 'sidebar',
        'name' => __('sidebar-right', 'text_domain'),
        'description' => __('Sidebar for the righthand side of the screen', 'text_domain'),
    );
    register_sidebar($sidebar_left);
    register_sidebar($sidebar_right);
}

add_action('widgets_init', 'custom_sidebars');
remove_filter('the_excerpt', 'wpautop');

//returns an array of the categories.
//This should probably have a feature that allows the user to set which categories appear and in what order.
function get_category_array() {
    $args = array(
        'type' => 'post',
        'child_of' => 0,
        'parent' => '',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 1,
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'number' => '',
        'taxonomy' => 'category',
        'pad_counts' => false
    );
    return get_categories($args);
}

function get_sorted_cat_arr() {
    $option_array = get_option('plugin_options');
    return explode(",", $option_array["category_order"]); //definitely my favorite PHP function
}

function live_coverage_enabled() {
    $live = get_option('plugin_options');
    if ($live["is_live"] == 1) {
        return true;
    } else {
        return false;
    }
}

function get_cat_object($category_str) {
    return get_term_by('name', $category_str, 'category');
}

function get_glyph($type) {
    if ($type == "video") {
        $color = "red";
        $glyph_string = "facetime-video";
    }
    if ($type == "audio") {
        $color = "black";
        $glyph_string = "volume-up";
    }
    if ($type == "gallery") {
        $color = "grey";
        $glyph_string = "picture";
    }
    if ($type == "comments") {
        $color = "white";
        $glyph_string = "comment";
    }
    return "<div style=\"color:" . $color . ";display:inline;\"><span class=\"glyphicon glyphicon-" . $glyph_string . "\"></span></div> ";
}

function get_category_glyph($category) {
    $default_glyph = "th-list";
    #this is probably awful and inefficent but hey whats a few loops among friends
    $custom_terms = get_terms("category");
    foreach ($custom_terms as $term) {
        if ($term->name == $category->name) {
            $src = get_tax_meta($term->term_id, 'glyphicon');
            if ($src == "") {
                return $default_glyph;
            }
            return $src;
        }
    }
}

function show_posts_by_tag($tag, $type_string, $glyph, $orderby) {
    ?>
    <div class="col-md-6">
        <h1><span class="glyphicon glyphicon-<?php echo $glyph ?>"></span> <?php echo $type_string ?> </h1>
        <table class="table table-striped table-condensed">
            <?php query_posts('orderby=' . $orderby . '&posts_per_page=5&tag=' . $tag); ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <tr>
                        <td>
                            <a href="<?php the_permalink(); ?>"><?php get_thumbnail(); ?></a>
                        </td>
                        <td>
                            <b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/>
                            <?php the_excerpt(); ?>
                            <br/>
                            <div class="glyphs"><?php get_media_glyphs(); ?></div>
                        </td>
                    </tr>
                    <?php
                endwhile;
            else: endif;
            ?>
        </table>
    </div>
    <?php
}

function get_thumbnail() {
    if (has_post_thumbnail()) {
        the_post_thumbnail(array(100, 100));
    } else {
        echo '<img src="' . get_template_directory_uri() . '/img/no_img.jpg"/>';
    }
}

function get_media_glyphs() {
    if (in_category("videos") || has_tag("video")) {
        echo get_glyph("video");
    }
    if (in_category("audio") || has_tag("audio")) {
        echo get_glyph("audio");
    }
    if (in_category("images") || has_tag("images") || has_tag("image") || has_tag("gallery")) {
        echo get_glyph("gallery");
    }
    echo "<span class=\"badge\">" . get_glyph("comments") . get_comments_number() . "</span>";
}

function show_posts($category) {
    ?>
    <div class="col-md-6">
        <a href="./category/<?php echo $category->slug ?>"><h1><span class="glyphicon glyphicon-<?php
                echo get_category_glyph($category);
                ?>"></span> <?php echo $category->name ?> </h1></a>
        <table class="table table-striped table-condensed">
            <?php query_posts('category_name=' . $category->name . '&post_status=publish,future=&posts_per_page=5'); ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <tr>
                        <td>
                            <a href="<?php the_permalink(); ?>"><?php get_thumbnail(); ?></a>
                        </td>
                        <td>
                            <b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/>
                            <?php the_excerpt(); ?>
                            <div class="glyphs"> <?php get_media_glyphs(); ?> </div>
                        </td>
                    </tr>
                    <?php
                endwhile;
            else: endif;
            ?>
        </table>
    </div>
    <?php
}

function get_carousel_image() {
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
    $thumb_url = $thumb_url_array[0];
    echo $thumb_url;
}

function display_post_collection() {
    ?>
    <table class="table table-striped table-condensed">
        <tr><td>
                <a href="<?php the_permalink(); ?>"><?php get_thumbnail(); ?></a></td>
        <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
        <td><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </b></a><br/><?php the_excerpt(); ?>
            <div class="glyphs"><?php get_media_glyphs(); ?></div>

        </td>
    </tr>
    </table>
    <?php
}
