<!DOCTYPE html>
<?php $page = !empty($page) ? "page--".$page.' ' : ''; ?>
<!--[if lt IE 7]>      <html lang="en" class="<?php echo $page ?>no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="<?php echo $page ?>no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="<?php echo $page ?>no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="<?php echo $page ?>no-js "> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo !empty($title) ? $title : APP_TITLE  ?></title>
		<meta name="description" content="<?php echo !empty($description) ? $description : APP_TITLE ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- dev : /css/style.css -->
		<?php $css = PROD ? '/css/style.min.css?v=957465612021901' : '/css/style.css?v='.time() ?>
		<link rel="stylesheet" href="<?php echo $css ?>">
		<script src="/js/modernizr.custom.js"></script>
	</head>
	<body>

		<!--[if lte IE 8]>
			<p class="obsolete-browser">You use an <strong>obsolete</strong> browser. <a href="http://browsehappy.com/" target="_blank">Update it</a> to navigate <strong>safely</strong> on the Internet!</p>
		<![endif]-->

		<div id="header" class="infobar">
			<h2 class="header__title">
				Who's the <em>best</em>?

				<?php if (CURRENT === $app->urlFor('fight')): ?>
					<a href="<?php echo $app->urlFor('top') ?>" class="header__subtitle">See the top 50</a>
				<?php endif ?>

				<?php if (CURRENT === $app->urlFor('top')): ?>
					<a href="<?php echo $app->urlFor('fight') ?>" class="header__subtitle">Fight!</a>
				<?php endif ?>
			</h2>
		</div>

		<div id="container">
			<?php if (!empty($flash)): ?>
			<?php foreach ($flash as $type => $message): ?>
				<p class="flash flash--<?php echo $type ?>"><?php echo $message ?></p>
			<?php endforeach ?>
			<?php endif ?>