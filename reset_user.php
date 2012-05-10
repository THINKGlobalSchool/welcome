<?php
/** Script to dismiss all users except for given array **/
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

if (elgg_is_admin_logged_in()) {
	$username = get_input('u');
	$user = get_user_by_username($username);
	
	if (!elgg_instanceof($user, 'user')) {
		echo "Invalid User";
	} else {
		welcome_reset_all($user);
		echo $user->username . " has been reset.";
	}
} else {
	forward();
}
