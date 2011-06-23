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

// Init function
elgg.welcome.init = function() {	
	// Admin lightbox
	$('.welcome-admin-lightbox').live('mouseover', function() {
		if (typeof(tinyMCE) !== 'undefined') {
			var content = tinyMCE.getInstanceById('popupcontent').getContent();
		} else {
			var content = $("#popupcontent").val();
		}		
		$('#preview-data').html(content);
	});

	// Click handler to dimiss the popup
	$('#welcome-dismiss-popup').live('click', elgg.welcome.dismissPopup);
	
	// Handle the change event for the dismiss checkbox
	$('#welcome-dismiss-check').live('change', function() {
		if ($(this).is(':checked')) {
			$(this).parent().html("<input class='elgg-button elgg-button-action' type='submit' id='welcome-dismiss-popup' href='welcomepopup' value='Do not show on next login' />");
		}
	});
}

// Function to dismiss a box/popup
elgg.welcome.dismissPopup = function(event) {
	
	elgg.action('welcome/dismiss', {
		data: {
			name: $(this).attr('href'),
		},
		success: function(json) {
			// Close fancybox
			$.fancybox.close();
		}
	});

	// Check off the item 
	$('.welcome-lightbox').addClass('strikeout');
	event.preventDefault();
}

elgg.register_hook_handler('init', 'system', elgg.welcome.init);
//</script>
