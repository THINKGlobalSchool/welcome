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
	$user = elgg_get_logged_in_user_entity();
	
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
	$user = elgg_get_logged_in_user_entity();
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
		$user = elgg_get_logged_in_user_entity();
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
	if (elgg_is_logged_in()) {
		if (!elgg_instanceof($user, 'user')) {
			$user = elgg_get_logged_in_user_entity();
		}
		//$user->welcome_dismissed = serialize(array());
	
		elgg_delete_metadata(array('guid' => $user->guid, 'metadata_name' => 'welcome_dismissed'));
	
		return $user->save();
	}
}

/**
 * Reset a given users specific dismissed message
 * 
 * @param string name name of the message to dismiss
 * @param ElggUser $user User to reset
 * @return bool
 */
function welcome_reset_dismissed_by_name($name, $user = NULL) {
	if (elgg_is_logged_in()) {
		if (!elgg_instanceof($user, 'user')) {
			$user = elgg_get_logged_in_user_entity();
		}
	
		$messages = unserialize($user->welcome_dismissed);

		if (array_key_exists($name, $messages)) {
			unset($messages[$name]);
			$user->welcome_dismissed = serialize($messages);
			return $user->save();
		}
	}
}


/**
 * Reset wether a user has viewed the intro item
 */
function welcome_reset_introitem($user = NULL) {
	if (!elgg_instanceof($user, 'user')) {
		$user = elgg_get_logged_in_user_entity();
	}
	// Get intro item from settings
	$intro_item = get_entity(elgg_get_plugin_setting('introentity', 'welcome'));
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
