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

// Get intro item from settings
//$intro_item = get_entity(elgg_get_plugin_setting('introentity', 'welcome'));
//if (!elgg_instanceof($intro_item, 'object')) {
// 	echo "<br />" . elgg_echo('welcome:error:invalidintroentity') . "<br /><br />";
//	return;
//}

// Determine if intro item has been 'viewed'
//if (welcome_has_user_viewed_entity($intro_item)) {
//	$viewed_item = TRUE;
//}

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
if (elgg_in_context('home')) {
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

$step1_link = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . 'welcome/loadpopup',
	'text' => elgg_echo('welcome:checklist:step1'),
	'class' => 'welcome-lightbox elgg-lightbox' . ($viewed_item ? ' strikeout' : ''),
	//'id' => 'welcome-viewed-video',
	));

$step2_link = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . "avatar/edit/{$user->username}",
	'text' => elgg_echo('welcome:checklist:step2'),
	'class' => $avatar ? 'strikeout' : ''
	));
	
$step3_link = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . "profile/{$user->username}/edit/details",
	'text' => elgg_echo('welcome:checklist:step3'),
	'class' => $profile ? 'strikeout' : ''
	));
	
$step4_text = "<span class='" . ($posted ? 'strikeout' : "") . "'>" . elgg_echo('welcome:checklist:step4') . "</span>";
		
$message = elgg_echo('welcome:checklist:message');	
		
$content = <<<HTML
		$message<br /><br />
		<ol>
			<li>$step1_link</li>
			<li>$step2_link</li>
			<li>$step3_link</li>
			<li>$step4_text</li>
		</ol>
HTML;

echo elgg_view_module($type, $header, $content, array('id' => 'welcome-sidebar'));
