<?php
/**
 * Welcome popup
 * - provides a new user checklist
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2013
 * @link http://www.thinkglobalschool.com/
 * 
 */

welcome_dismiss_message('new_spot_tut');
?>
<script type='text/javascript'>
	fire_new_spot_tut = function() {
		$(document).ready(function() {

			if ($('.elgg-feedback').position().top > 800) {
				$('.elgg-feedback').animate({top: '150px'});
			}

			setTimeout(function(){
				$('.welcome-nav-tutorial-start').click();
			}, 600);
		});
	};
	// Need to click AFTER elgg is initted
	elgg.register_hook_handler('ready', 'system', fire_new_spot_tut);
</script>

