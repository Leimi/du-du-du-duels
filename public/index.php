<?php
	require_once __DIR__.'/../app/config/init.php';

	require_once MODELS_PATH.'/fighter.php';
	require_once MODELS_PATH.'/fight.php';

	require_once ROUTES_PATH.'/fighters.php';
	require_once ROUTES_PATH.'/fights.php';

	require_once LIB_PATH.'/private.php';

	$app->run();
?>