<?php
/**
 * Welcome start.php
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

$english = array(
	
	// Generic/Built-in
	'admin:plugin_settings:welcome' => 'Welcome Plugin Settings',
	
	// Checklist
	'welcome:checklist:step1' => 'Watch intro video',
	'welcome:checklist:step2' => 'Upload a profile pic',
	'welcome:checklist:step3' => 'Fill out your profile',
	'welcome:checklist:step4' => 'Introduce yourself',
	'welcome:checklist:message' => 'Here\'s a few suggestions to get you going on Spot',
	'welcome:checklist:dismissconfirm' => 'Are you sure you are done? Proceeding will close the Getting Started list forever.', 
	
	// Labels
	'welcome:label:introentity' => 'Checklist intro entity guid',
	'welcome:label:popupcontent' => 'Content to appear in modal popup',
	'welcome:label:popupcontent_1' => 'Content to appear in role popup #1 (Default popup for all other users)',
	'welcome:label:popupcontent_2' => 'Content to appear in role popup #2',
	'welcome:label:popupcontent_parent' => 'Content to appear in parent popup',
	'welcome:label:previewpopup' => 'Preview Popup',
	'welcome:label:previewpopup_1' => 'Preview Role Popup #1',
	'welcome:label:previewpopup_2' => 'Preview Role Popup #2',
	'welcome:label:previewpopup_parent' => 'Preview Parent Popup',
//	'welcome:label:welcomeparents' => 'Welcome to Spot',
	
	// Messages
	'welcome:error:dismiss' => 'There was an error dismissing this message',
	'welcome:error:invalidintroentity' => 'Invalid or non-existant intro item entity. Double-check the welcome plugin settings.',
	'welcome:success:saved' => 'Preference saved',
);

add_translation('en',$english);
