<?php
/**
 * Welcome start.php
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2013
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
	elgg_extend_view('page/elements/sidebar', 'welcome/module', 1);
	
	// Extend parent portal
	elgg_extend_view('parentportal/extend_left', 'welcome/module');
	
	// Extend CSS
	elgg_extend_view('css/elgg', 'css/welcome/css');
	elgg_extend_view('css/admin', 'css/welcome/css');
	//elgg_extend_view('css/admin', 'embed/css');

	// Extend tgstheme 'home/content_top' to add checklist to home page
	elgg_extend_view('tgstheme/home/content_top', 'welcome/module'); 

	// Page handler
	elgg_register_page_handler('welcome_popup', 'welcome_page_handler');

	// Actions
	$action_base = elgg_get_plugins_path() . 'welcome/actions/welcome';
	elgg_register_action('welcome/dismiss' , "$action_base/dismiss.php");
	elgg_register_action('welcome/view' , "$action_base/view.php");
	
	// Register the popup with ECML
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'welcome_ecml_views_hook');
	
	// Register JS
	$welcome_js = elgg_get_simplecache_url('js', 'welcome/welcome');
	elgg_register_simplecache_view('js/welcome/welcome');
	elgg_register_js('elgg.welcome', $welcome_js);

	// Register intro.js css/js
	$i = elgg_get_simplecache_url('js', 'intro_js');
	elgg_register_simplecache_view('js/intro_js');
	elgg_register_js('intro.js', $i);

	$i = elgg_get_simplecache_url('css', 'intro_js');
	elgg_register_simplecache_view('css/intro_js');
	elgg_register_css('intro.js', $i);

	// Load lightbox CSS & JS
	elgg_load_css('lightbox');

	// Logged in only
	if (elgg_is_logged_in()) {
		// Load JS
		elgg_load_js('lightbox');
		elgg_load_js('elgg.welcome');

		elgg_load_js('intro.js');
		elgg_load_css('intro.js');

		// Topbar menu hook
		elgg_register_plugin_hook_handler('register', 'menu:topbar', 'welcome_topbar_menu_handler');
	} 
}

/**
 * Pagesetup hook
 */
function welcome_pagesetup() {
	if (!isset($_SESSION['welcome_popup']) && elgg_is_logged_in() && !welcome_is_message_dismissed('welcomepopup')) {
		elgg_extend_view('page/elements/footer', 'welcome/autopopup');

		// Extend parentportal to include hidden 
		//elgg_extend_view('parentportal/extend_left', 'welcome/parent_module');

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

/**
 * Hook into topbar menu hook and add a new tutorial button
 */
function welcome_topbar_menu_handler($hook, $type, $items, $params) {
	$tut_item = ElggMenuItem::factory(array(
		'name' => 'nav_tut',
		'href' => '#',
		'link_class' => 'elgg-button elgg-button-delete welcome-nav-tutorial-start',
		'text' => 'What\'s new?' . elgg_view('welcome/tut_js'), 
		'priority' => 999999,
	));

	$tut_item->setSection('default');

	$items[] = $tut_item;

	return $items;
}

elgg_register_event_handler('init', 'system', 'welcome_init');
elgg_register_event_handler('pagesetup', 'system', 'welcome_pagesetup');

