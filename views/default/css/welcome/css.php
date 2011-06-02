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
?>
/**<style>**/

#welcome-sidebar {
	margin-bottom: 20px;
}

#welcome-sidebar .right {
	float: right;
}

#welcome-sidebar .small {
	font-size: 80%;
}

#welcome-sidebar .strikeout {
	text-decoration: line-through;
}

/** Tinybox **/
.tbox {
	padding:10px; 
/**	background: #fff url(<?php echo elgg_get_site_url().'mod/activityper/images/'?>preload.gif) no-repeat 50% 50%; **/
	background: #fff;
	border:10px solid #e3e3e3; 
	z-index:9999;
}

.tmask {position:absolute; display:none; top:0px; left:0px; height:100%; width:100%; background:#000; z-index:9998}

#tinymask {
	position: absolute; 
	display: none; 
	top: 0; 
	left: 0; 
	height: 100%; 
	width: 100%; 
	background: #000; 
	z-index: 9998;

}

#tinycontent {
	background: #fff;
}

/**</style>**/