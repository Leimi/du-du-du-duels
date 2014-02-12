<!DOCTYPE html>
<?php $this->page = !empty($this->page) ? "page--".$this->page.' ' : ''; ?>
<!--[if lt IE 7]>      <html lang="en" class="<?php echo $this->page ?>no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="<?php echo $this->page ?>no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="<?php echo $this->page ?>no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="<?php echo $this->page ?>no-js "> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo !empty($this->title) ? $this->title : APP_TITLE  ?></title>
		<meta name="description" content="<?php echo !empty($this->description) ? $this->description : APP_TITLE ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- dev : /css/style.css -->
		<?php $this->css = PROD ? '/css/style.min.css?v=957465612021901' : '/css/style.css?v='.time() ?>
		<link rel="stylesheet" href="<?php echo $this->css ?>">
		<script src="/js/modernizr.custom.js"></script>
	</head>
	<body>

		<!--[if lte IE 8]>
			<p class="obsolete-browser">You use an <strong>obsolete</strong> browser. <a href="http://browsehappy.com/" target="_blank">Update it</a> to navigate <strong>safely</strong> on the Internet!</p>
		<![endif]-->

		<div id="header" class="infobar header">
			<h2 class="header__title">
				Who's the <em>best</em>?

				<?php if (CURRENT === $this->app->urlFor('fight')): ?>
					<a href="<?php echo $this->app->urlFor('top') ?>" class="header__subtitle">See the top</a>
				<?php endif ?>

				<?php if (CURRENT === $this->app->urlFor('top')): ?>
					<a href="<?php echo $this->app->urlFor('fight') ?>" class="header__subtitle">Fight!</a>
				<?php endif ?>
			</h2>
		</div>

		<div id="container" class="u-cf">
			<?php if (!empty($this->flash)): ?>
			<?php foreach ($this->flash as $type => $message): ?>
				<p class="flash flash--<?php echo $type ?>"><?php echo $message ?></p>
			<?php endforeach ?>
			<?php endif ?>

			<?php echo $this->child() ?>
		</div>

		<div id="footer">
			<h1 class="website-title">Hearthstone cards duels: fight! <a href="<?php echo $this->app->urlFor('fight') ?>">Choose the best cards</a> and <a href="<?php echo $this->app->urlFor('top') ?>">see their rank</a>.</h1>
		</div>

		<script src="http://static.wowhead.com/widgets/power.js"></script>
		<!-- dev : /js/script.js -->
		<?php $this->js = PROD ? '/js/script.min.js?v=58797562341' :
			array('/components/jquery/jquery.js', '/js/mousetooltip.js', '/js/script.js');
		$t = time();
		if (is_string($this->js)): ?>
		<script src="<?php echo $this->js ?>"></script>
		<?php else: foreach ($this->js as $script): ?>
		<script src="<?php echo $script ?>?v=<?php echo $t ?>"></script>
		<?php endforeach; endif; ?>
	</body>
</html>