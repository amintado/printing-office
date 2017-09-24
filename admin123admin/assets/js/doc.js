/*
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

$(document).ready(function() {

	// Check user OS
	if(navigator.appVersion.indexOf('Mac') != -1) {
		$('body').addClass('mac');
	}

	// Init syntax highlighter
	SyntaxHighlighter.defaults.toolbar = false;
	SyntaxHighlighter.all();

	// Init sidebar
	$('#sidebar li').click(function(e) {

		var $li = $(this);

		// Do nothing if it's the active menu
		if( $li.hasClass('active') ) { return false; }

		// Highlight the menu item
		$li.addClass('active').siblings().removeClass('active');

		// Show new section
		$('#content > div > section').removeClass('active').eq( $li.index() ).addClass('active');

		// Scroll to top
		$('#content').scrollTop(0);

		// Filter out triggered events
		if( ! e.isTrigger ) {

			// Update hash
			document.location.hash = $li.data('hash');
		}
	});



	$('.img-holder img').each(function() {

		var $img 	= $(this),
			width 	= parseInt( $img.attr('width') ),
			height 	= parseInt( $img.attr('height') ),
			ratio 	= 1;

		if( width && height ) {
			$img.parent().css('padding-bottom', (height / width * 100)+'%' );

		// Fallback if no sizes specified
		} else {
			$img.parent().removeClass('img-holder');
		}
	});


	// Fix clicking on the active menu item
	$('section nav ul li a').click(function() {
		if( document.location.hash === $(this).attr('href') ) {
			$(window).trigger('hashchange');
		}
	});


	// JumpTo functionality
	$(window).on('hashchange', function(e) {
		e.preventDefault();

		var hash 		= document.location.hash.substr(1),
			$target 	= $('[data-target="'+hash+'"]'),
			$section 	= $target.closest('section');

		if( $target.length && $section.length ) {

			$('#sidebar li').eq( $section.index() ).trigger('click');

			var scrollTop = $('#content').scrollTop() + $target.offset().top;
				scrollTop = scrollTop < 50 ? 0 : scrollTop;

			$('#content').stop(true, true).animate({ scrollTop: scrollTop }, 500);
		}
	}).trigger('hashchange');

});