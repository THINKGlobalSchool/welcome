<?php
/**
 * Welcome popup
 * - provides a new user checklist
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$role = get_input('force_role');

$first_role = elgg_get_plugin_setting('first_role', 'welcome');
$second_role = elgg_get_plugin_setting('second_role', 'welcome');

$user = elgg_get_logged_in_user_entity();
$user_guid = $user->guid;

// Default Content
$content = elgg_get_plugin_setting('popupcontent_1', 'welcome');

if ($role == $second_role || (!$role && !$user->is_parent && roles_is_member($second_role, $user_guid))) {
	$content = elgg_get_plugin_setting('popupcontent_2', 'welcome');
} else if ($role == 'parent' || (!$role && $user->is_parent)) {
	$content = elgg_get_plugin_setting('popupcontent_parent', 'welcome');
}

$content = elgg_view('output/longtext', array('value' => $content));

$content .= "<div class='welcome-lightbox-controls'><strong>Do not show on next login?</strong>&nbsp;<input id='welcome-dismiss-check' type='checkbox' /></div>";

echo $content;