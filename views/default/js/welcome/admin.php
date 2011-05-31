<?php
/**
 * Welcome admin JS library
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

elgg.provide('elgg.welcome.admin');

// Init function
elgg.welcome.admin.init = function() {
	
	// Click handler for preview button
	$('#welcome-preview-button').live('click', elgg.welcome.admin.preview_popup);
}

elgg.welcome.admin.preview_popup = function(event) {
	if (typeof(tinyMCE) !== 'undefined') {
		var content = tinyMCE.get('params[popupcontent]').getContent();
	} else {
		var content = $("#popupcontent").val();
	}
	TINY.box.show(content,0,0,0,1);
	event.preventDefault();
}

elgg.register_event_handler('init', 'system', elgg.welcome.admin.init);
//</script>
