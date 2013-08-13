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

#welcome-sidebar ol {
	list-style: decimal inside none;
}

#welcome-sidebar.elgg-module-featured > .elgg-head {
	background: #85161D;
}

.welcome-lightbox-controls {
	width: 98%; 
	padding-top: 5px;
	padding-bottom: 5px; 
	text-align: right;
}

/** intro.js tutorial specific styles **/

.elgg-menu-topbar li a.welcome-nav-tutorial-start {
	-webkit-transition: color 1s linear;
	-moz-transition: color 1s linear;
	-ms-transition: color 1s linear;
	-o-transition: color 1s linear;
	transition: color 1s linear;
	font-size: 12px;
	border: 1px solid #2D3F46;
	margin-left: 40px;
	border-left: none;
	border-right: none;
}

.welcome-nav-tutorial-start.glow {

    color: black;
}

body > .introjs-helperLayer {
  position: absolute;
  z-index: 9999998;
  background-color: #FFF;
  background-color: rgba(255,255,255,.2);
  border: 1px solid #777;
  border: 1px solid rgba(0,0,0,.5);
  border-radius: 4px;
  box-shadow: 0 2px 15px rgba(0,0,0,.4);
  -webkit-transition: all 0.3s ease-out;
     -moz-transition: all 0.3s ease-out;
      -ms-transition: all 0.3s ease-out;
       -o-transition: all 0.3s ease-out;
          transition: all 0.3s ease-out;
}

.introjs-helperNumberLayerBottomRight {
    bottom: -16px;
    left: auto !important;
    right: -16px;
    top: auto !important;
}

/**</style>**/