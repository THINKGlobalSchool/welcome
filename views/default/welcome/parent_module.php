<?php
/**
 * Welcome module for parentportal
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

echo elgg_view('output/url', array(
	'href' => elgg_get_site_url() . 'welcome/loadpopup',
	'text' => elgg_echo('welcome:checklist:step1'),
	'class' => 'welcome-lightbox elgg-lightbox',
	'style' => 'display: none;',
));
