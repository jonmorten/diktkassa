require('Modernizr');

var $ = require('jquery');

require('foundation');
$(document).foundation();

$(document).ready(function( $ ) {
	'use strict';

	// Info text in footer
	$('.info-button').on('click touchstart', function(e) {
		e.preventDefault();
		$('.info-button').toggleClass('active');
		$('.info-text').toggle();
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
	});

});
