<?php
# USER ID
function _user_id()
{
	global $userdata;
	get_currentuserinfo();
	echo $userdata->ID;
}
function _get_user_id()
{
	global $userdata;
	get_currentuserinfo();
	return $userdata->ID;
}
#USER NAME
function _user_name()
{
	global $userdata;
	get_currentuserinfo();
	echo $userdata->user_login;
}
function _get_user_name()
{
	global $userdata;
	get_currentuserinfo();
	return $userdata->user_login;
}
#USER LEVEL
function _user_level()
{
	global $userdata;
	get_currentuserinfo();
	echo $userdata->user_level;
}
function _get_user_level()
{
	global $userdata;
	get_currentuserinfo();
	return $userdata->user_level;
}
?>