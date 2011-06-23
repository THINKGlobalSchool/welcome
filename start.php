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

	// Register and load library
	elgg_register_library('welcome', elgg_get_plugins_path() . 'welcome/lib/welcome.php');
	elgg_load_library('welcome');
		
	// Debug..
	//welcome_reset_all();
	
	// Extend Sidebar
	elgg_extend_view('page/elements/sidebar', 'welcome/sidebar');
	
	// Extend CSS
	elgg_extend_view('css/elgg', 'css/welcome/css');
	elgg_extend_view('css/admin', 'css/welcome/css');
	//elgg_extend_view('css/admin', 'embed/css');
	
	// Page handler
	elgg_register_page_handler('welcome', 'welcome_page_handler');

	// Actions
	$action_base = elgg_get_plugins_path() . 'welcome/actions/welcome';
	elgg_register_action('welcome/dismiss' , "$action_base/dismiss.php");
	elgg_register_action('welcome/view' , "$action_base/view.php");
	
	// Register the popup with ECML
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'welcome_ecml_views_hook');
	
	// Register JS
	$welcome_js = elgg_get_simplecache_url('js', 'welcome/welcome');
	elgg_register_js('elgg.welcome', $welcome_js);

	$admin_js = elgg_get_simplecache_url('js', 'welcome/admin');
	elgg_register_js('elgg.welcome.admin', $admin_js);
	
	// Load lightbox CSS & JS
	elgg_load_css('lightbox');

	// Load JS if logged in
	if (elgg_is_logged_in()) {
		elgg_load_js('lightbox');
		elgg_load_js('elgg.welcome');
	} 
}

/**
 * Pagesetup hook
 */
function welcome_pagesetup() {
	if (!isset($_SESSION['welcome_popup']) && elgg_is_logged_in() && !welcome_is_message_dismissed('welcomepopup')) {
		elgg_extend_view('page/elements/footer', 'welcome/autopopup');
		$_SESSION['welcome_popup'] = TRUE;
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

