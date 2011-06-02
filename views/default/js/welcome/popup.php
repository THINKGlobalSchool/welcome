<?php
/**
 * Welcome JS library
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

elgg.welcome.popup.URL = 'pg/welcome/loadpopup';

// Init function
elgg.welcome.popup.init = function() {	
	// Only logged in users
	if (elgg.isloggedin() && !elgg.welcome.popup.isDismissed) {
		$(function() {
			// Load
			elgg.get(elgg.welcome.popup.URL, {
				data: {}, 
				success: function(data) {
					data = "<a style='float: right;' id='welcome-close-popup' href='#'><strong>[Close]</strong></a><div style='clear: both;'></div>" + data;
					data += "<a style='float: right;' id='welcome-dismiss-popup' href='welcomepopup'>Don't show again</a><div style='clear: both;'></div>";
					
					TINY.box.show(data,0,0,0,1);
				},
			})
		});
	}
	
	// Click handler to dimiss the popup
	$('#welcome-dismiss-popup').live('click', elgg.welcome.popup.dismiss);
	
	// Click handler to close the popup
	$('#welcome-close-popup').live('click', function() { TINY.box.hide(); });
}

// Function to dismiss a box/popup
elgg.welcome.popup.dismiss = function(event) {
	elgg.action('welcome/dismiss', {
		data: {
			name: $(this).attr('href'),
		},
		success: function(json) {
			TINY.box.hide();
		}
	});
	event.preventDefault();
}

elgg.register_event_handler('init', 'system', elgg.welcome.popup.init);
//</script>
