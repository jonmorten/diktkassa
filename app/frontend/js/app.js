require('Modernizr');

var $ = require('jquery');


$(document).ready(function( $ ) {
	'use strict';

	// Info text in footer
	$('.info-button').on('click touchstart', function(e) {
		e.preventDefault();
		$('.info-button').toggleClass('active');
		$('.info-text').toggle();
	});

});
