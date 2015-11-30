<?php
//Add thumbnail support
add_theme_support('post-thumbnails');
//For taxonomy meta. This is how custom fields are added to a category page. 
//in this case, its fto set a glyphicon.
require_once("tax-meta-class/Tax-meta-class.php");
require_once('custom-options.php');
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
//Enable bootstrap with jquery
function wpbootstrap_scripts_with_jquery() {
    // Register the script like this for a theme:
    wp_register_script('custom-script', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('custom-script');
}

add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery');
//Code to get first image from a post. Used in the carousel.
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
//Code to display comments. Called in comments.php using the &callback= function.
function display_comments($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    ?>
    <blockquote>
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
        </blockquote>

    <?php
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
        'class'=>'sidebar',
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
function get_sorted_cat_arr(){
    $option_array = get_option('plugin_options');
    return explode(",", $option_array["category_order"]); //definitely my favorite PHP function
}
function get_cat_object($category_str){
    return get_term_by('name',$category_str,'category');
}
    
function display_catagory($category){
}
function get_video_glyph(){
    return "<div style=\"color:red;display:inline;\"><span class=\"glyphicon glyphicon-facetime-video\"></span></div>";
}
function get_category_glyph($category){
                            $default_glyph = "th-list";
                            #this is probably awful and inefficent but hey whats a few loops among friends
                            $custom_terms = get_terms("category");
                            foreach ($custom_terms as $term) {
                                if ($term->name == $category->name) {

                                    $src = get_tax_meta($term->term_id, 'glyphicon');
                                    if($src==""){
                                        return $default_glyph;
                                    }
                                    return $src;
                                }
                            }
}
