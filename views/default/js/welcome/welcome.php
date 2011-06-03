<?php
/**
 * Welcome main JS library
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

?>
//<script>

elgg.provide('elgg.welcome');

elgg.welcome.popupURL = 'pg/welcome/loadpopup';

// Init function
elgg.welcome.init = function() {	
	
	// Click handler to dimiss the popup
	$('#welcome-dismiss-popup').live('click', elgg.welcome.dismissPopup);
	
	// Click handler to close the popup
	$('#welcome-close-popup').live('click', function() { TINY.box.hide(); });
	
	// Click handler for intro checklist item, shows the popup
	$('#welcome-viewed-video').live('click', function(event) {
		elgg.welcome.showPopup();
		event.preventDefault();
	});
	
	// Handle the change event for the dismiss checkbox
	$('#welcome-dismiss-check').live('change', function() {
		if ($(this).is(':checked')) {
			$(this).parent().html("<input type='submit' id='welcome-dismiss-popup' href='welcomepopup' value='Do not show on next login' />");
		}
	});
}

// Show the popup
elgg.welcome.showPopup = function() {
	// Load
	elgg.get(elgg.welcome.popupURL, {
		data: {}, 
		success: function(data) {
			data = "<a style='float: right;' id='welcome-close-popup' href='#'><strong>[Close]</strong></a><div style='clear: both;'></div>" + data;
			data += "<span style='float: right;'><strong>Do not show on next login?</strong>&nbsp;<input id='welcome-dismiss-check' type='checkbox' /></span><div style='clear: both;'></div>";

			TINY.box.show({
				html: data,
				animate: true,
				mask: true,
				top: 100,
			});
		},
	});
}

// Function to dismiss a box/popup
elgg.welcome.dismissPopup = function(event) {
	
	elgg.action('welcome/dismiss', {
		data: {
			name: $(this).attr('href'),
		},
		success: function(json) {
			TINY.box.hide();
		}
	});

	// Check off the item 
	$('#welcome-viewed-video').addClass('strikeout');
	
	event.preventDefault();
}

elgg.register_event_handler('init', 'system', elgg.welcome.init);
//</script>
