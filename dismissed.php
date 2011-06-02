<?php
/** Script to display all site users current 'dismissed' status **/

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

if (isadminloggedin()) {
	$users = elgg_get_entities(array(
		'types' => array('user'),
		'limit' => 0, 
	));
	
	foreach($users as $user) {
		echo "<pre>" . $user->guid . " - " . $user->username . "\n";
		
		$dismissed_array = unserialize($user->welcome_dismissed);
		
		if (!$dismissed_array) {
			echo "none";
		} else {
			print_r($dismissed_array);
		}
		
		echo "</pre>";
	}	
} else {
	forward();
}
