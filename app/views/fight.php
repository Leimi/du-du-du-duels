<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<form action="<?php echo $app->urlFor('post-fight') ?>" class="fight" method="POST">
<h2 class="fight__title">Who's the <em>best?</em></h2>
<input type="hidden" name="<?php echo $csrf_key; ?>" value="<?php echo $csrf_token; ?>">
<?php
if (!empty($fighters)):
	$type = array('player', 'opponent');
	foreach ($fighters as $fighterKey => $fighter): ?><div class="fighter fighter--<?php echo $type[$fighterKey] ?>">
			<input type="hidden" name="<?php echo $type[$fighterKey] ?>_id" value="<?php echo $fighter->id ?>" />
			<input type="image" src="<?php echo Halp::fighterImgPath($fighter); ?>" alt="<?php echo $fighter->name ?>" name="<?php echo $type[$fighterKey] ?>_wins" class="fighter__img" value="<?php echo $fighter->name ?>" />
			<div class="fighter__more-info">
				<a href="http://www.hearthhead.com/card=<?php echo $fighter->hhId ?>&amp;text" target="_blank"><?php echo $fighter->name ?> <span class="icon-small-arrow-up-right" title="See this card on Hearthhead"></span></a>
			</div>
		</div><?php endforeach ?>
	<input type="submit" name="draw" value="Draw" />
<?php endif ?>
</form>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>