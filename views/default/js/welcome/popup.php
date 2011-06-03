<?php
/**
 * Welcome Auto popup JS library
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

// This is all kinds of stupid.. I think its fixed in SVN
require_once(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) . "/engine/start.php");

// Don't bother checking anything if we're not logged in
if (isloggedin()) {
	$is_dismissed = welcome_is_message_dismissed('welcomepopup');
}

?>
//<script>

elgg.provide('elgg.welcome.popup');

elgg.welcome.popup.isDismissed = '<?php echo $is_dismissed; ?>';

// Init function
elgg.welcome.popup.init = function() {	
	// Only logged in users
	if (elgg.isloggedin() && !elgg.welcome.popup.isDismissed) {
		$(function() {
			elgg.welcome.showPopup();
		});
	}
}

elgg.register_event_handler('init', 'system', elgg.welcome.popup.init);
//</script>
