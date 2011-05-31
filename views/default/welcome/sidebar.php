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

$user = get_loggedin_user();

// Check if we have a user or that the checklist has been dismissed
if (!$user || welcome_is_message_dismissed("checklist") || get_context() == 'admin') {
	return;
}

// Get intro item from settings
$intro_item = get_entity(get_plugin_setting('introentity', 'welcome'));
if (!elgg_instanceof($intro_item, 'object')) {
  	echo "<br />" . elgg_echo('welcome:error:invalidintroentity') . "<br /><br />";
	return;
}

// Determine if intro item has been 'viewed'
if (welcome_has_user_viewed_entity($intro_item)) {
	$viewed_item = true;
}

// Determine if avatar is set
if (!strpos($user->getIcon(),'default')) { 
	$avatar = true; 
}

// Determine if profile been filled out
$profile_fields = elgg_get_config('profile'); // Note: this is profile_fields in >= 1.8
foreach ($profile_fields as $shortname => $valuetype) {
	if ($user->$shortname) {
		//we have at least one profile field complete
		$profile = true;
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
	$posted = true;
}

//@todo - dismiss via AJAX
$close_url = elgg_add_action_tokens_to_url(elgg_get_site_url() . 'action/welcome/dismiss?name=checklist');
$close_link = elgg_view('output/confirmlink', array(
	'href' => $close_url,
	'text' => '[Close]',
	'confirm' => elgg_echo('welcome:checklist:dismissconfirm'),
	'class' => 'small right'
));

$view_url = elgg_add_action_tokens_to_url(elgg_get_site_url() . "action/welcome/view?guid={$intro_item->guid}", false);

$header = "Getting Started {$close_link}";

$step1_link = elgg_view('output/url', array(
	'href' => $view_url,
	'text' => elgg_echo('welcome:checklist:step1'),
	'class' => $viewed_item ? 'strikeout' : ''
	));

$step2_link = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . 'pg/profile/edit/' . $user->username,
	'text' => elgg_echo('welcome:checklist:step2'),
	'class' => $avatar ? 'strikeout' : ''
	));
	
$step3_link = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . 'pg/profile/' . $user->username . '/edit',
	'text' => elgg_echo('welcome:checklist:step3'),
	'class' => $profile ? 'strikeout' : ''
	));

$step4_link = elgg_view('output/url', array(
	'href' => elgg_get_site_url() . 'pg/activity',
	'text' => elgg_echo('welcome:checklist:step4'),
	'class' => $posted ? 'strikeout' : ''
	));
		
$message = elgg_echo('welcome:checklist:message');	
		
$content = <<<HTML
	<div id='welcome-sidebar'>
		<h3>$header</h3>
		<p>$message</p>
		<ol>
			<li>$step1_link</li>
			<li>$step2_link</li>
			<li>$step3_link</li>
			<li>$step4_link</li>
		</ol>
	</div>
HTML;

echo $content;
