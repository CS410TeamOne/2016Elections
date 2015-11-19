<?php
# ID BY PAGE NAME
function _get_ID_by_page_name($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name_id;
}
# PAGE NAME BY ID
function _get_name_by_page_ID($page_id)
{
	global $wpdb;
	$pageid_name = $wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE ID = '".$page_id."'");
	return $pageid_name;
}

# DEPTH
function _get_depth($id = '', $depth = '', $i = 0)
{
	global $wpdb;
	global $post;
	
	if($depth == '')
	{
		if(is_page())
		{
			if($id == '')
			{
				$id = $post->ID;
			}
			$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$id."'");
			return _get_depth($id, $depth, $i);
		}
	}
	elseif($depth == "0")
	{	
		return $i;
	}
	else
	{
		$depth = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID = '".$depth."'");
		$i++;
		return _get_depth($id, $depth, $i);
	}
}

# IS CHILD - Requires DEPTH function
function _is_child($id = '')
{
	if(_get_depth($id)>0)
	{
		return true;
	}
}

# IS GRANDCHILD - Requires DEPTH function
function _is_grandchild($id = '')
{
	if(_get_depth($id)>1)
	{
		return true;
	}
}
?>