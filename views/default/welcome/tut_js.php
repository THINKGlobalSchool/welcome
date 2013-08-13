<?php
/**
 * Welcome tutorial ajax js
 * 
 * @package Welcome
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2013
 * @link http://www.thinkglobalschool.com/
 * 
 */
?>
<script type='text/javascript'>
	// Init intro.js
	var glow = $('.welcome-nav-tutorial-start'); // Make the tutorial link glow

	$(document).ready(function() {

		// setTimeout(function() {
		// 	setInterval(function(){
		// 	//glow.hasClass('glow') ? glow.removeClass('glow') : glow.addClass('glow');
		// 		$(".welcome-nav-tutorial-start").parent().effect( "pulsate", {times:2}, 500 );
		// 	}, 3000);
		// }, 1000);

		$('.welcome-nav-tutorial-start').bind('click', function(event) {
			var intro = introJs();

			var $_this = $(this);

			$_this.fadeOut();

			intro.setOptions({
				steps: [
					{
						element: document.querySelector('.elgg-page-topbar > .elgg-inner'),
						intro: "Welcome to the new Spot menu!"
					},
					{
						element: document.querySelector('.elgg-menu-item-my-groups > a'),
						intro: "Hover your mouse here to view your groups",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-item-explore > a'),
						intro: "Hover here to explore Spot content",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-item-profile > a'),
						intro: "Click here to view your profile, or hover for more options",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-item-search'),
						intro: "Better search! Start typing to search for user groups and content!",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-quickbar'),
						intro: "These are links to some important groups",
						numberLayerClass: 'introjs-helperNumberLayerBottomRight'
					}

				]
			});

			intro.start();

			var welcomeDone = function() {
				$_this.fadeIn();
			}

			intro.onexit(welcomeDone);
			//intro.oncomplete(welcomeDone);

			event.preventDefault();
		});
	});


</script>