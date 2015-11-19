<?php
# PARENT PERMALINK
function _parent_permalink()
{
	global $post;
	echo get_permalink($post->post_parent);
}
function _get_parent_permalink()
{
	global $post;
	return get_permalink($post->post_parent);
}
# PERMALINK BY NAME
function _permalink_by_name($page_name)
{
	global $post;
	echo get_permalink(_get_name_by_page_ID($page_name));
}
function _get_permalink_by_name($page_name)
{
	global $post;
	return get_permalink(_get_name_by_page_ID($page_name));
}
?>