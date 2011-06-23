<?php
/**
 * Welcome plugin settings
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */
?>
<br />
<div>
    <label><?php echo elgg_echo('welcome:label:popupcontent'); ?></label><br />
    <?php 
		echo elgg_view('input/longtext', array(
			'id' => 'popupcontent',
			'name' => 'params[popupcontent]', 
			'value' => $vars['entity']->popupcontent)
		); 
	?>
	<br />
	<a href='#preview-data' class='elgg-lightbox welcome-admin-lightbox'><?php echo elgg_echo('welcome:label:previewpopup'); ?></a>
	<div style='display: none;'><div id='preview-data'></div></div>
</div>
