var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": false };

(function() {
	$body = $('body');

	MouseTooltip.init();

	if ( $('html.page--fight').length ) {
		var clearFightClasses = function(el) {
			$('.fighter').removeClass('fighter--loser').removeClass('fighter--winner').removeClass('fighter--draw');
		};

		var addWinningFightClasses = function(el) {
			clearFightClasses();
			var $el = $(el).closest('.fighter').addClass('fighter--winner');
			$('.fighter').not($el).addClass('fighter--loser');
		};

		var addDrawFightClasses = function(el) {
			clearFightClasses();
			$('.fighter').addClass('fighter--draw');
		};

		$body.on('mouseenter focus', '.fighter__img', function() {
			addWinningFightClasses(this);
		});
		$body.on('mouseenter focus', '.fight__draw', function() {
			addDrawFightClasses(this);
		});
		$body.on('mouseleave blur', '.fighter__img, .fight__draw', function() {
			clearFightClasses(this);
		});
	}

	$body.on('click', 'a[data-ajax-url][data-ajax-container]', function(e) {
		e.preventDefault();
		var $link = $(e.currentTarget);
		$.ajax({
			url: $link.attr('data-ajax-url'),
			success: function(result) {
				$( $link.attr('data-ajax-container') ).html(result);
			},
			error: function() {
				window.location.href = $link.attr('href');
			}
		});
	});
})();