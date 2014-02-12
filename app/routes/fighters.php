<?php
use RedBean_Facade as R;

function fighterDetails($id) {
	return Model_Fighter::details($id);
}

$app->get('/top(/)(:id/?)', function($id = null) use ($app) {
	$threshold = 1000;
	$count = Model_Fight::total();
	$fighters = Model_Fighter::top(150);
	$ranks = Model_Rank::last();
	$viewVars = array(
		'page' => 'fighters',
		'fighters' => array_values($fighters),
		'ranks' => $ranks,
		'threshold' => $threshold,
		'count' => $count,
		'remaining' => $threshold - $count
	);

	if ($id && is_numeric($id))
		$viewVars['details'] = fighterDetails($id);

	$app->render('pages/top', $viewVars);
})->name('top');

$app->get('/details/:id', function($id = null) use ($app) {
	$app->render('elements/top-item-details', array('fighter' => fighterDetails($id)));
})->name('details');
