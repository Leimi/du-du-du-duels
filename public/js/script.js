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


	if ( $('html.page--fighters').length ) {
		function handleTooltip(e, content) {
			if (!content)
				content = $(e.currentTarget).attr('data-tooltip');
			if (e.type == "mouseover")
				MouseTooltip.show( content );
			else if (e.type == "click")
				MouseTooltip.html( content );
			else
				MouseTooltip.hide();
		}
		MouseTooltip.init({ "3d": false });
		$body.on('mouseover click mouseout', '.top-item__position', function(e) {
			handleTooltip(e, $(e.currentTarget).find('[data-tooltip]').attr('data-tooltip') );
	}	);
		$body.on('mouseover click mouseout', '.top-item__ratio', function(e) {
			handleTooltip(e);
		});
	}
})();