<?php
	require dirname(__FILE__).'/../app/config/init.php';
	require_once LIB_PATH.'/osef.php';
	require_once MODELS_PATH.'/fighter.php';
	require_once MODELS_PATH.'/fight.php';
	require_once ROUTES_PATH.'/all.php';

	$app->run();
?>