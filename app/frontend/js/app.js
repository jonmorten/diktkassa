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

	// Poem rating
	(function() {
		var $ratePoemButton = $('[data-rate-poem]').first();
		if ($ratePoemButton.length < 1) {
			return false;
		}

		var onRate = $.noop;
		var rateEventHandler = function(event) {
			event.preventDefault();
			onRate(event, this);
		};

		var $poemRatingContainer = $('[data-poem-rating]').first();
		var updateUserRatingClass = function (rating) {
			$poemRatingContainer.removeClass(function(i, class_names) {
				var removeClassNames = [];
				$.each(class_names.split(' '), function(){
					if (this.indexOf('poem-rating-') === 0) {
						removeClassNames.push(this);
					}
				});
				return removeClassNames.join('');
			}).addClass('poem-is-rated poem-rating-' + rating);
		};

		var poem_id = $ratePoemButton.data('rate-poem');
		var Fingerprint = require('fingerprint');
		var fingerprint = new Fingerprint({canvas: true}).get();

		$.ajax({
			url: '/json/getPoemRateInfo',
			type: 'GET',
			data: {
				'fingerprint': fingerprint,
				'id': poem_id
			},
			success: function (data, textStatus, jqXHR) {
				var rate_poem_url = data.url || false;
				if (!!rate_poem_url) {
					var has_rated = data.has_rated || false;
					if (!!has_rated) {
						updateUserRatingClass(data.rating || 0);
					}

					var rateRequestInProgress = false;
					onRate = function(event, obj) {
						var rating = $(obj).find('.icon-full:visible').length;
						updateUserRatingClass(rating);

						if (!rateRequestInProgress) {
							rateRequestInProgress = true;
							$.ajax({
								url: rate_poem_url,
								type: 'POST',
								data: {
									'fingerprint': fingerprint,
									'id': poem_id,
									'rating': rating
								},
								success: function (data, textStatus, jqXHR) {
									rateRequestInProgress = false;
									var rating = data.rating || false;
									if (!!rating) {
										$poemRatingContainer.attr('data-poem-rating', rating);
									}
								}
							});
						}
					}
				}
			}
		});

		$ratePoemButton.on('click.ratePoemButton', rateEventHandler);
	})();

});
