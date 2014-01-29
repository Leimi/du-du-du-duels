var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": false };

(function() {
	$body = $('body');

	$body.on('mouseenter', '.fighter__img', function() {
		var $this = $(this).closest('.fighter').addClass('fighter--winner');
		$('.fighter').not($this).addClass('fighter--loser');
	});
	$body.on('mouseleave', '.fighter__img', function() {
		$('.fighter').removeClass('fighter--loser').removeClass('fighter--winner');
	});

	$body.on('mouseenter', '.fight__draw', function() {
		$('.fighter').addClass('fighter--draw');
	});
	$body.on('mouseleave', '.fight__draw', function() {
		$('.fighter').removeClass('fighter--draw');
	});
})();