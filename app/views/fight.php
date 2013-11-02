<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<form action="<?php echo $app->urlFor('post-fight') ?>" method="POST">
<input type="hidden" name="<?php echo $csrf_key; ?>" value="<?php echo $csrf_token; ?>">
<?php if (!empty($fighters)): ?>
	<input type="hidden" name="player_id" value="<?php echo $fighters[0]->id ?>" />
	<input type="hidden" name="opponent_id" value="<?php echo $fighters[1]->id ?>" />
	<input type="submit" name="player_wins" value="<?php echo $fighters[0]->name ?>" />
	<input type="submit" name="opponent_wins" value="<?php echo $fighters[1]->name ?>" />
	<input type="submit" name="draw" value="Draw" />
<?php endif ?>
</form>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>