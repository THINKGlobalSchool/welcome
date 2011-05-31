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


?>
//<script>

elgg.provide('elgg.welcome');

elgg.welcome.popupURL = 'pg/welcome/loadpopup';

// Init function
elgg.welcome.init = function() {
	$(function() {
		// Load
		elgg.get(elgg.welcome.popupURL, {
			data: {}, 
			success: function(data) {
				TINY.box.show(data,0,0,0,1);
			},
		})
	});
}


elgg.register_event_handler('init', 'system', elgg.welcome.init);
//</script>
