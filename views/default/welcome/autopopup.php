<?php
/**
 * Welcome popup
 * - provides a new user checklist
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */
?>
<script type='text/javascript'>
	welcome_click_video = function() {
		$(document).ready(function() {
			$('.welcome-lightbox').click()
		});
	};
	// Need to click AFTER elgg is initted
	elgg.register_hook_handler('ready', 'system', welcome_click_video);
</script>

