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
	
	// Actions
	$action_base = elgg_get_plugin_path() . 'welcome/actions/welcome';
	elgg_register_action('welcome/dismiss' , "$action_base/dismiss.php");
	elgg_register_action('welcome/view' , "$action_base/view.php");
}

elgg_register_event_handler('init', 'system', 'welcome_init');
