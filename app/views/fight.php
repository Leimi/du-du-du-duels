<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<form action="<?php echo $app->urlFor('post-fight') ?>" class="fight" method="POST">
<input type="hidden" name="<?php echo $csrf_key; ?>" value="<?php echo $csrf_token; ?>">
<?php
if (!empty($fighters)):
	$type = array('player', 'opponent');
	foreach ($fighters as $fighterKey => $fighter): ?>
		<div class="fighter fighter--<?php echo $type[$fighterKey] ?>">
			<input type="hidden" name="<?php echo $type[$fighterKey] ?>_id" value="<?php echo $fighter->id ?>" />
			<div class="fighter__img">
				<?php echo Halp::fighterImg($fighter); ?>
			</div>
			<input type="submit" name="<?php echo $type[$fighterKey] ?>_wins" class="fighter__name" value="<?php echo $fighter->name ?>" />
		</div>
	<?php endforeach ?>
	<input type="submit" name="draw" value="Draw" />
<?php endif ?>
</form>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>