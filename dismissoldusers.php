<?php
/** Script to dismiss all users except for given array **/
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

if (isadminloggedin()) {
	$users = elgg_get_entities(array(
		'types' => array('user'),
		'limit' => 0, 
	));
	
	// Excluding new 2011 students
	$exclude = array(
		'isaacf',
		'hannahc',
		'russellc',
		'sulemand',
		'rebeccag',
		'emmag',
		'conradh',
		'cameronl',
		'mayam',
		'ahmads',
		'gawas',
		'claudiat',
	);
	
	echo "Excluding: <pre>";
	print_r($exclude);
	echo "</pre>";
	
	foreach($users as $user) {
		if (in_array($user->username, $exclude)) {
			echo "Excluded: " . $user->username . "</br>";
			continue;
		} else {
			// Dismiss everything for this user
			remove_metadata($user->guid, 'welcome_dismissed');
			$items = array(
				'welcomepopup' => TRUE, 
				'checklist' => TRUE,
			);
			$user->welcome_dismissed = serialize($items);
			$user->save();
			echo "Dismissed: " . $user->username . "</br>";
		}
	}	
} else {
	forward();
}
