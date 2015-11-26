<?php
require_once("tax-meta-class/Tax-meta-class.php");
$config = array(
   'id' => 'glyph',                         // meta box id, unique per meta box
   'title' => 'Glyphicons',                      // meta box title
   'pages' => array('category'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
   'fields' => array(),                             // list of meta fields (can be added by field arrays)
   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
   'use_with_theme' => true           //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
$my_meta = new Tax_Meta_Class($config);
//text field
$my_meta->addText('glyphicon', array('name' => 'Glyphicon'));
//textarea field
$my_meta->Finish();
function wpbootstrap_scripts_with_jquery() {
    // Register the script like this for a theme:
    wp_register_script('custom-script', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('custom-script');
}

add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery');
?>
<?php

function echo_first_image($postID) {
    $args = array(
        'numberposts' => 1,
        'order' => 'ASC',
        'post_mime_type' => 'image',
        'post_parent' => $postID,
        'post_status' => null,
        'post_type' => 'attachment',
    );

    $attachments = get_children($args);

    if ($attachments) {
        foreach ($attachments as $attachment) {
            $image_attributes = wp_get_attachment_image_src($attachment->ID, 'full') ? wp_get_attachment_image_src($attachment->ID, 'full') : wp_get_attachment_image_src($attachment->ID, 'full');

            echo wp_get_attachment_url($attachment->ID) . '" class="current">';
        }
    }
}
#Code to display comments. Called in comments.php using the &callback= function.
function display_comments($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    ?>
    <?php if ($depth == 1) :
        ?>
        </div>
    <?php endif; ?>
    <?php
    $darken = '';
    if ($depth % 2 == 0) {
        $darken = "style='background-color:lightgrey'";
    }
    ?>
    <div class="well well-sm" <?php echo $darken ?>>
        <?php printf(__('%s'), get_comment_author_link()) ?>
        | <a class="comment-permalink" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s'), get_comment_date(), get_comment_time()) ?></a> | 
    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        <hr/>

    <?php if ($comment->comment_approved == '0') : ?>

            <em><php _e('Your comment is awaiting moderation.') ?></em><br />

            <?php endif; ?>
        <p>
    <?php comment_text(); ?>
        </p>

        <?php if ($depth > 1) :
            ?>
        </div>
    <?php endif; ?>

    <?php
}

function custom_sidebars() {

    $args = array(
        'id' => 'twitter',
        'class' => 'sidebar',
        'name' => __('twitter', 'text_domain'),
        'description' => __('To display popular discussions sidebar', 'text_domain'),
    );
    register_sidebar($args);
}

add_action('widgets_init', 'custom_sidebars');
remove_filter('the_excerpt', 'wpautop');
function get_category_array(){
    $args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 

);
return get_categories( $args );
}
function display_catagory($category){
    

}
