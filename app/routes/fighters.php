<?php

$app->get('/top', function() use ($app) {
	$threshold = 5000;
	$count = Model_Fight::total();
	$fighters = Model_Fighter::top();
	$app->render('top.php', array('fighters' => $fighters, 'count' => $count, 'threshold' => $threshold, 'remaining' => $threshold - $count));
})->name('top');