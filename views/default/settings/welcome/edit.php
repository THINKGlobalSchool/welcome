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
<div>
    <label><?php echo elgg_echo('welcome:label:introentity'); ?></label>
    <?php 
		echo elgg_view('input/text', array(
			'internalname' => 'params[introentity]', 
			'value' => $vars['entity']->introentity)
		); 
	?>
</div>
<br /><br />
<div>
    <label><?php echo elgg_echo('welcome:label:popupcontent'); ?></label><br />
    <?php 
		echo elgg_view('input/longtext', array(
			'internalid' => 'popupcontent',
			'internalname' => 'params[popupcontent]', 
			'value' => $vars['entity']->popupcontent)
		); 
	?>
	<br />
	<a href='#' id='welcome-preview-button'><?php echo elgg_echo('welcome:label:previewpopup'); ?></a>
</div>
