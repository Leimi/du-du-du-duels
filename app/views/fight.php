<?php if (!$this->app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<form action="<?php echo $this->app->urlFor('post-fight') ?>" class="fight" method="POST">
	<?php if (!empty($this->fighters)): ?>

	<div class="fight__fighters">
	<?php $type = array('player', 'opponent');
	foreach ($this->fighters as $fighterKey => $fighter): ?><div class="fighter fighter--<?php echo $type[$fighterKey] ?>">

			<input type="hidden" name="<?php echo $type[$fighterKey] ?>_id" value="<?php echo $fighter->id ?>" />

			<div class="fighter__img-wrapper">
				<input type="image" src="<?php echo Halp::fighterImgPath($fighter); ?>" alt="<?php echo $fighter->name ?>" name="<?php echo $type[$fighterKey] ?>_wins" title="<?php echo $fighter->name ?> is obviously better!" class="fighter__img" value="<?php echo $fighter->name ?>" />
			</div>

			<div class="fighter__more-info">
				<a href="http://www.hearthhead.com/card=<?php echo $fighter->hhId ?>&amp;text" target="_blank"><?php echo $fighter->name ?></a>
			</div>

		</div><?php if ($fighterKey === 0): ?><div class="fight__between">
			<div class="fight__vs-wrapper"><div class="fight__vs">vs</div></div>
			<div class="fight__draw">
				<input type="submit" name="draw" title="Choosing is too difficult, I call it a draw!" class="fight__draw hearthstone-button" value="Draw" />
			</div>
		</div><?php endif ?><?php endforeach ?>
	</div>

	<div class="fight__skip">
		<a href="<?php echo $this->app->urlFor('fight') ?>">Skip this duel</a>
	</div>


	<?php endif ?>

	<input type="hidden" name="<?php echo $this->csrf_key; ?>" value="<?php echo $this->csrf_token; ?>">
</form>

<?php if (!$this->app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>