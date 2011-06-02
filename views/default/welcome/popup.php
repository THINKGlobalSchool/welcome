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
	$content = get_plugin_setting('popupcontent', 'welcome');
}

$popup =  elgg_view('output/longtext', array(
	'value' => $content,
));

echo ecml_parse_string($content);