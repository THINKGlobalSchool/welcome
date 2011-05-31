<?php
/**
 * Dismiss message action 
 * - Dismisses a given message 
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$name = get_input('name');
if (!$name || !welcome_dismiss_message($name)) { 
	$error = elgg_echo('welcome:error:dismiss');
}

if ($error) {
	register_error($error);
} else {
	system_message(elgg_echo('welcome:success:saved'));
}

forward(REFERER);
