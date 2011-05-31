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

echo elgg_view('output/longtext', array(
	'value' => get_plugin_setting('popupcontent', 'welcome'),
));