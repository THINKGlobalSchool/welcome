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
						intro: "Welcome to the new Spot menu! We have worked hard to streamline getting around and finding what you're looking for. This tour will give you a brief introduction to some of the changes."
					},
					{
						element: document.querySelector('.elgg-menu-item-my-groups > a'),
						intro: "Hover your mouse here to view your groups. Try it now!",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-item-explore > a'),
						intro: "The old main menu has been replaced by the Explore menu. Hover your mouse here to explore Spot content.",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-item-profile > a'),
						intro: "Click here to view your profile, or hover for more options.",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-item-search'),
						intro: "Better search! Start typing to quickly search for users, groups and content!",
						position: 'left'
					},
					{
						element: document.querySelector('.elgg-menu-quickbar'),
						intro: "These are quick links to important Spot content.",
						numberLayerClass: 'introjs-helperNumberLayerBottomRight'
					},
					{
						element: document.querySelector('.elgg-module-publish'),
						intro: "The old 'something to share' box and publish menu have been combined into a single easy access toolbar.",
						numberLayerClass: 'introjs-helperNumberLayerBottomRight'
					},
					{
						element: document.querySelector('.spot-topbar-logo'),
						intro: "Click here to go back to the home page."
					},
					{
						element: document.querySelector('.elgg-feedback'),
						intro: 'This major Spot update is the first in a series of updates that are under development to help make Spot a more effective and enjoyable site for all of the TGS community.<br /><br />As always, if you have any comments suggestions or questions, please click here to provide instant feedback.',
						position: 'right',
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