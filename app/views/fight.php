<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<form action="<?php echo $app->urlFor('post-fight') ?>" class="fight" method="POST">
	<?php if (!empty($fighters)): ?>

	<div class="fight__fighters">
	<?php $type = array('player', 'opponent');
	foreach ($fighters as $fighterKey => $fighter): ?><div class="fighter fighter--<?php echo $type[$fighterKey] ?>">

			<input type="hidden" name="<?php echo $type[$fighterKey] ?>_id" value="<?php echo $fighter->id ?>" />

			<div class="fighter__img-wrapper">
				<input type="image" src="<?php echo Halp::fighterImgPath($fighter); ?>" alt="<?php echo $fighter->name ?>" name="<?php echo $type[$fighterKey] ?>_wins" class="fighter__img" value="<?php echo $fighter->name ?>" />
			</div>

			<div class="fighter__more-info">
				<a href="http://www.hearthhead.com/card=<?php echo $fighter->hhId ?>&amp;text" target="_blank"><?php echo $fighter->name ?> <span class="icon-small-arrow-up-right" title="See this card on Hearthhead"></span></a>
			</div>

		</div><?php if ($fighterKey === 0): ?><div class="fighter__vs">vs</div><?php endif ?><?php endforeach ?>
	</div>

	<input type="submit" name="draw" class="fight__draw" value="Draw" />
	<?php endif ?>

	<input type="hidden" name="<?php echo $csrf_key; ?>" value="<?php echo $csrf_token; ?>">
</form>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>