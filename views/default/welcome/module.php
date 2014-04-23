<?php
/**
 * Welcome sidebar
 * - provides a new user checklist
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$user = elgg_get_logged_in_user_entity();

// Check if we have a user or that the checklist has been dismissed
if (!$user || welcome_is_message_dismissed("checklist") || elgg_get_context() == 'admin') {
	return;
}

// Check if the popup has been dismissed
if (welcome_is_message_dismissed("welcomepopup")) {
	$viewed_item = TRUE;
}

// Determine if avatar is set
if (!strpos($user->getIconURL(),'default')) { 
	$avatar = TRUE; 
}

// Determine if profile been filled out
$profile_fields = elgg_get_config('profile_fields'); 
foreach ($profile_fields as $shortname => $valuetype) {
	if ($user->$shortname) {
		//we have at least one profile field complete
		$profile = TRUE;
		break;
	}
}

// Determine is user has made a wire post
$options = array(
	'type' => 'object',
	'subtype' => 'thewire',
	'limit' => 1,
	'container_guid' => $user->guid
);
$wire_posts = elgg_get_entities($options);
// Got at least 1 post, they've posted something
if ($wire_posts) {
	$posted = TRUE;
}

// If we're on the home page, use a different module
if (elgg_in_context('home') || elgg_in_context('parentportal') || elgg_in_context('widgets')) {
	$type = 'featured';
	$close_text = 'Close&nbsp;<span class="elgg-icon elgg-icon-delete right"></span>';
	$close_class = 'right';
} else {
	$type = 'aside';
	$close_text = '[close]';
	$close_class = 'small right';
}

//@todo - dismiss via AJAX
$close_url = elgg_add_action_tokens_to_url(elgg_get_site_url() . 'action/welcome/dismiss?name=checklist');
$close_link = elgg_view('output/confirmlink', array(
	'href' => $close_url,
	'text' => $close_text,
	'confirm' => elgg_echo('welcome:checklist:dismissconfirm'),
	'class' => $close_class
));

$view_url = elgg_add_action_tokens_to_url(elgg_get_site_url() . "action/welcome/view?guid={$intro_item->guid}", FALSE);

$header = "Getting Started {$close_link}";

// Array to store checklist items
$items = array();

$items[] = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . 'welcome_popup/loadpopup',
	'text' => elgg_echo('welcome:checklist:step1'),
	'class' => 'welcome-lightbox elgg-lightbox' . ($viewed_item ? ' strikeout' : ''),
));

$items[] = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . "avatar/edit/{$user->username}",
	'text' => elgg_echo('welcome:checklist:step2'),
	'class' => $avatar ? 'strikeout' : ''
));
	
$items[] = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . "profile/{$user->username}/edit/details",
	'text' => elgg_echo('welcome:checklist:step3'),
	'class' => $profile ? 'strikeout' : ''
));

$items[] = "<span class='" . ($posted ? 'strikeout' : "") . "'>" . elgg_echo('welcome:checklist:step4') . "</span>";

// Let plugins customize items
$items = elgg_trigger_plugin_hook('items', 'welcome', array('context' => elgg_get_context()), $items);
	
// Get description, fall back to default
$description = elgg_get_plugin_setting('checklist_description', 'welcome') ? elgg_get_plugin_setting('checklist_description', 'welcome') : elgg_echo('welcome:checklist:message');

$content = "$description<br /><br /><ol>";

foreach ($items as $item) {
	$content .= "<li>$item</li>";
}

$content .= "</ol>";

if (!elgg_in_context('widgets')) {
	// Allow content to be extended
	$content .= elgg_view('welcome/module_extend');
	echo elgg_view_module($type, $header, $content, array('id' => 'welcome-sidebar'));
} else {
	echo "<div id='welcome-sidebar'>{$content}</div>";
}