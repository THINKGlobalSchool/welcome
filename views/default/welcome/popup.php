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

if ($vars['content']) {
	$content = $vars['content'];
} else {
	$content = elgg_get_plugin_setting('popupcontent', 'welcome');
}

$content .= "<div class='welcome-lightbox-controls'><strong>Do not show on next login?</strong>&nbsp;<input id='welcome-dismiss-check' type='checkbox' /></div>";

echo $content;

//echo ecml_parse_string($content);