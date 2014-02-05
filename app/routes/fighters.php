<?php

$app->get('/top', function() use ($app) {
	$threshold = 5000;
	$count = Model_Fight::total();
	$fighters = Model_Fighter::top(150);
	$ranks = Model_Rank::last();
	$app->render('top.php', array('page' => 'fighters', 'fighters' => array_values($fighters), 'ranks' => $ranks, 'count' => $count, 'threshold' => $threshold, 'remaining' => $threshold - $count));
})->name('top');