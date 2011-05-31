<?php
/**
 * Welcome 'view' action
 * - Sets a relationship that the user has viewd a given item
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$item = get_entity(get_input('guid'));

$user = get_loggedin_user();

if (elgg_instanceof($user, 'user') && elgg_instanceof($item, 'object')) {
	// Add relationship and forward to the item
	add_entity_relationship($user->guid, 'has_viewed_welcome_item', $item->guid);
	forward($item->getURL());
} 

// Just forward if theres an error..
forward();
