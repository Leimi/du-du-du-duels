<?php

$app->get('/', function() use ($app) {
	$fighters = Model_Fighter::getFighters();
	$fightersValues = array_values($fighters);
	$fightersIds = array_keys($fighters);
	$_SESSION['fighters'] = $fightersIds;
	$app->render('fight.php', array('fighters' => $fightersValues));
})->name('home');

$app->post('/fight', function() use ($app) {
	//we check that the fighters are the ones we gave to the view earlier
	$originalFighters = !empty($_SESSION['fighters']) ? $_SESSION['fighters'] : null;
	$playerId = filter_input(INPUT_POST, 'player_id', FILTER_SANITIZE_NUMBER_INT);
	$opponentId = filter_input(INPUT_POST, 'opponent_id', FILTER_SANITIZE_NUMBER_INT);
	unset($_SESSION['fighters']);

	if (empty($playerId) || empty($opponentId)) {
		$app->flash('error', "Who's playing, man?");
		$app->redirect($app->urlFor('home'));
	}

	if (empty($originalFighters) || $playerId !== $originalFighters[0] || $opponentId !== $originalFighters[1]) {
		$app->flash('error', "I see what you did there.");
		$app->redirect($app->urlFor('home'));
	}

	if (isset($_POST['player_wins']))
		$playerWins = filter_input(INPUT_POST, 'player_wins', FILTER_SANITIZE_STRING);
	if (isset($_POST['opponent_wins']))
		$opponentWins = filter_input(INPUT_POST, 'opponent_wins', FILTER_SANITIZE_STRING);
	if (isset($_POST['draw']))
		$draw = true;
	if ( (empty($playerWins) && empty($opponentWins) && empty($draw)) || (!empty($playerWins) && !empty($opponentWins) && !empty($draw)) ) {
		$app->flash('error', "Someone has to win, bro.");
		$app->redirect($app->urlFor('home'));
	}
	$fightResult = !empty($playerWins) ? 'win' : (!empty($opponentWins) ? 'lose' : 'draw');

	$fight = Model_Fighter::addFight($playerId, $opponentId, $fightResult);

	if ($fight) {
		$app->flash('success', "Well played!");
		$app->redirect($app->urlFor('home'));
	}
})->name('post-fight');

$app->get('/bot/fillDB', function() use($app) {
	require __DIR__.'/../../bot/fillDB.php';
});