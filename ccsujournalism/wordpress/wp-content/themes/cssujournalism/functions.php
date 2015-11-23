<?php

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

function display_comments($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    ?>
    <?php if ($depth == 1) :
        ?>
        </div>
        <?php endif; ?>
    <div class="well well-sm">
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
