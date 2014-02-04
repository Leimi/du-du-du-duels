<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<?php if ($remaining > 0): ?>
<p class="warning">Currently, less than <?php echo round($count, ($count > 100 ? -2 : -1)) ?> duels occured in total. That's not much: the top 50 can change rather quickly.</p>
<?php endif ?>

<table class="top striped">
	<tr>
		<th colspan=2>Rank</th>
		<th>Ratio</th>
		<th>Card</th>
	</tr>
	<?php if (!empty($fighters)):
	$i = $rank = 1;
	$prevScore = null;
	foreach ($fighters as $key => $fighter):
		$diff = isset($ranks->diff[$key]) ? $ranks->diff[$key] : null;
		$rank = $prevScore === $fighter->score ? $rank : $i; ?>
	<tr>

		<td data-rank="<?php echo $rank ?>" data-score="<?php echo $fighter->score ?>" title="Score: <?php echo $fighter->score ?>"><?php echo $rank.'.' ?></td>

		<?php if (!is_null($diff)): ?>
		<td data-position="<?php echo $diff ?>"><?php echo Halp::rankIcon($diff) ?></td>
		<?php else: ?>
		<td></td>
		<?php endif ?>

		<td data-fights="<?php echo $fighter->fights ?>">
			<div class="progress">
				<div class="progress__bar progress__bar--win" style="width: <?php echo $fighter->wins / $fighter->fights * 100 ?>%"></div>
				<div class="progress__bar progress__bar--draw" style="width: <?php echo $fighter->draws / $fighter->fights * 100 ?>%"></div>
				<div class="progress__bar progress__bar--lost" style="width: <?php echo $fighter->losts / $fighter->fights * 100 ?>%"></div>
			</div>
		</td>

		<td data-id="<?php echo $fighter->id ?>">
			<a style='background-image: url("<?php echo Halp::fighterImgPath($fighter, array('thumb' => true)); ?>")' class="top-item__card-preview" href="http://www.hearthhead.com/card=<?php echo $fighter->hhId ?>" target="_blank"><?php echo $fighter->name ?></a>
		</td>

	</tr>
	<?php
		$prevScore = $fighter->score;
		$i++;
	endforeach; endif; ?>
</table>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>