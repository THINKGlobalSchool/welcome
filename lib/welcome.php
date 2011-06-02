<?php
/**
 * Welcome helper lib
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

/**
 * Dismiss a message with given name
 * 
 * @param string $name Name of message
 * @return bool
 */
function welcome_dismiss_message($name) {
	$user = get_loggedin_user();
	
	if ($user->welcome_dismissed) {
		$items = unserialize($user->welcome_dismissed);
	} else {
		$items = array();
	}

	$items[$name] = true;
	$user->welcome_dismissed = serialize($items);
	$user->save();
	
	return true;
}

/**
 * Determine if a user has dismissed a message with 
 * given name
 *
 * @param string $name Name of message
 * @return bool
 */
function welcome_is_message_dismissed($name) {
	$user = get_loggedin_user();
	$items = unserialize($user->welcome_dismissed);

	if ($items[$name]) {
		return true;
	} else {
		return false;
	}
}

/**
 * Determine wether user has viewed given entity 
 * 
 * @param ElggEntity $entity Entity to check
 * @param ElggUser	$user User to check
 * @return bool
 */
function welcome_has_user_viewed_entity($entity, $user = NULL) {
	if (!elgg_instanceof($entity, 'object')) {
		return false;
	}
	
	if (!elgg_instanceof($user, 'user')) {
		$user = get_loggedin_user();
	}
	
	return check_entity_relationship($user->guid, 'has_viewed_welcome_item', $entity->guid);
}


/**
 * Reset a given users dismissed messages
 * 
 * @param ElggUser $user User to reset
 * @return bool
 */
function welcome_reset_dismissed($user = NULL) {
	if (isloggedin()) {
		if (!elgg_instanceof($user, 'user')) {
			$user = get_loggedin_user();
		}
		//$user->welcome_dismissed = serialize(array());
	
		remove_metadata($user->guid, 'welcome_dismissed');
	
		return $user->save();
	}
}

/**
 * Reset wether a use has viewed the intro item
 */
function welcome_reset_introitem($user = NULL) {
	if (!elgg_instanceof($user, 'user')) {
		$user = get_loggedin_user();
	}
	// Get intro item from settings
	$intro_item = get_entity(get_plugin_setting('introentity', 'welcome'));
	return remove_entity_relationship($user->guid, 'has_viewed_welcome_item', $intro_item->guid);
}

/**
 * Wrapper to reset all welcome data
 */
function welcome_reset_all($user = NULL) {
	// Clear dismissed
	welcome_reset_dismissed($user);
	// Clear introitem relationship
	welcome_reset_introitem($user);
	// Nuke session
	unset($_SESSION['welcome_popup']);
}
