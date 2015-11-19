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
            $image_attributes = wp_get_attachment_image_src($attachment->ID, 'thumbnail') ? wp_get_attachment_image_src($attachment->ID, 'thumbnail') : wp_get_attachment_image_src($attachment->ID, 'full');

            echo wp_get_attachment_thumb_url($attachment->ID) . '" class="current">';
        }
    }
}

remove_filter('the_excerpt', 'wpautop');
