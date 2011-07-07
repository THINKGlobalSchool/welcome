<?php
/**
 * Welcome start.php
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

/**
 * Init the welcome plugin
 */
function welcome_init() {

	// Include helpers
	require_once 'lib/welcome.php';
		
	// Debug..
	//welcome_reset_all();
	
	// Extend sidebar (by extending owner_block.. this is because pre 1.8 is gross)
	elgg_extend_view('page_elements/owner_block','welcome/sidebar', 500);
	
	// Extend CSS
	elgg_extend_view('css/screen', 'css/welcome/css');
	elgg_extend_view('css/admin', 'css/welcome/css');
	elgg_extend_view('css/admin', 'embed/css');
	
	// Page handler
	register_page_handler('welcome', 'welcome_page_handler');

	// Actions
	$action_base = elgg_get_plugin_path() . 'welcome/actions/welcome';
	elgg_register_action('welcome/dismiss' , "$action_base/dismiss.php");
	elgg_register_action('welcome/view' , "$action_base/view.php");
	
	// Register the popup with ECML
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'welcome_ecml_views_hook');
}

/**
 * Pagesetup hook, only for JS
 */
function welcome_pagesetup() {
	// Register Tinybox JS (might not need this in 1.8)
	elgg_register_js(elgg_get_site_url() . 'mod/welcome/vendors/tinybox/tinybox.js', 'tinybox');
	
	if (get_context() == 'admin') {
		// Register Welcome admin JS
		elgg_register_js(elgg_get_site_url() . 'mod/welcome/views/default/js/welcome/admin.php', 'elgg.welcome.admin');
	} else {
		// Register general popup JS
		elgg_register_js(elgg_get_site_url() . 'mod/welcome/views/default/js/welcome/welcome.php', 'elgg.welcome');
		
		// Only autoload the popup JS once per session
		if (!isset($_SESSION['welcome_popup']) && isloggedin() && !is_user_parent(get_loggedin_user())) {
			// Register Welcome JS popup
			elgg_register_js(elgg_get_site_url() . 'mod/welcome/views/default/js/welcome/popup.php', 'elgg.welcome.popup');
			// Set session
			$_SESSION['welcome_popup'] = true;
		}
	}	
}

/**
 * Welcome page handler
 * - Dispatches welcome pages
 */
function welcome_page_handler($page) {
	$page_type = $page[0];

	switch($page_type) {
		case 'loadpopup':
			echo elgg_view('welcome/popup', array('content' => get_input('preview', FALSE)));
			exit;
			break;
		default: 
			// Do nothing..
			forward();
			break;
	}
	
	return true;
}

/**
 * Parse popup for ECML
 */
function welcome_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['welcome/popup'] = elgg_echo('welcome');

	return $return_value;
}

elgg_register_event_handler('init', 'system', 'welcome_init');
elgg_register_event_handler('pagesetup', 'system', 'welcome_pagesetup');
