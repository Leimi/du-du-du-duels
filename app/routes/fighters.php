<?php

$app->get('/top', function() use ($app) {
	$fighters = Model_Fighter::top();
	$app->render('top.php', array('fighters' => $fighters));
})->name('top');