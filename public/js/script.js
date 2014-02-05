var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": false };

(function() {
	$body = $('body');

	if ( $('html.page--fight').length ) {
		function clearFightClasses(el) {
			$('.fighter').removeClass('fighter--loser').removeClass('fighter--winner').removeClass('fighter--draw');
		}

		function addWinningFightClasses(el) {
			clearFightClasses();
			var $el = $(el).closest('.fighter').addClass('fighter--winner');
			$('.fighter').not($el).addClass('fighter--loser');
		}

		function addDrawFightClasses(el) {
			clearFightClasses();
			$('.fighter').addClass('fighter--draw');
		}

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

})();