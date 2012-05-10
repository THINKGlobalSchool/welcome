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

$popup_url = elgg_get_site_url() . 'welcome/loadpopup';

$first_popup_label = elgg_echo('welcome:label:popupcontent_1');
$first_popup_input = elgg_view('input/longtext', array(
	'id' => 'popupcontent_1',
	'name' => 'params[popupcontent_1]', 
	'value' => $vars['entity']->popupcontent_1)
);

$second_popup_label = elgg_echo('welcome:label:popupcontent_2');
$second_popup_input = elgg_view('input/longtext', array(
	'id' => 'popupcontent_2',
	'name' => 'params[popupcontent_2]', 
	'value' => $vars['entity']->popupcontent_2)
);

$parent_popup_label = elgg_echo('welcome:label:popupcontent_parent');
$parent_popup_input = elgg_view('input/longtext', array(
	'id' => 'popupcontent_parent',
	'name' => 'params[popupcontent_parent]', 
	'value' => $vars['entity']->popupcontent_parent)
);

$first_role_select = elgg_view('input/roledropdown', array(
	'name' => 'params[first_role]',
	'id' => 'first-role',
	'value' => $vars['entity']->first_role,
	'show_hidden' => TRUE,
));

$second_role_select = elgg_view('input/roledropdown', array(
	'name' => 'params[second_role]',
	'id' => 'second-role',
	'value' => $vars['entity']->second_role,
	'show_hidden' => TRUE,
));

$first_preview_link = elgg_view('output/url', array(
	'text' => elgg_echo('welcome:label:previewpopup_1'),
	'href' => $popup_url . "?force_role={$vars['entity']->first_role}",
	'class' => 'elgg-button elgg-button-submit elgg-lightbox welcome-admin-lightbox',
));

$second_preview_link = elgg_view('output/url', array(
	'text' => elgg_echo('welcome:label:previewpopup_2'),
	'href' => $popup_url . "?force_role={$vars['entity']->second_role}",
	'class' => 'elgg-button elgg-button-submit elgg-lightbox welcome-admin-lightbox',
));

$parent_preview_link = elgg_view('output/url', array(
	'text' => elgg_echo('welcome:label:previewpopup_parent'),
	'href' => $popup_url . "?force_role=parent",
	'class' => 'elgg-button elgg-button-submit elgg-lightbox welcome-admin-lightbox',
));


$content = <<<HTML
	<br />
	<div>
		<label>$first_popup_label</label><br /><br />
		$first_role_select
		<br /><br />
		$first_popup_input
		<br />
		$first_preview_link
	</div>
	<div>
		<label>$second_popup_label</label><br /><br />
		$second_role_select
		<br /><br />
		$second_popup_input
		<br />
		$second_preview_link
	</div>
	<div>
		<label>$parent_popup_label</label><br /><br />
		$parent_popup_input
		<br />
		$parent_preview_link
	</div>
HTML;

echo $content;