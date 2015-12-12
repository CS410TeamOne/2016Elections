<?php
# DELETE POST LINK
function _delete_post_link($link = 'Delete This', $before = '', $after = '')
{
	global $post;
	
	if ( $post->post_type == 'page' ) {
		if ( !current_user_can( 'edit_page', $post->ID ) )
			return;
	} else {
		if ( !current_user_can( 'edit_post', $post->ID ) )
			return;
	}
	$link = "<a href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . "'>".$link."</a>";
	echo $before . $link . $after;
}

# MAX PAGES
function _max_pages()
{
	global $wp_query;
	echo $wp_query->max_num_pages;
}
function _get_max_pages()
{
	global $wp_query;
	return $wp_query->max_num_pages;
}

# GET THE CONTENT WITH FORMATTING
function _get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
?>