<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<?php if ($remaining > 0): ?>
<p class="warning">Currently, less than <?php echo round($count, ($count > 100 ? -2 : -1)) ?> duels occured in total. That's not much: the charts can change rather quickly.</p>
<?php endif ?>

<table class="top striped u-pullLeft">
	<tr>
		<th colspan=2 class="with-tooltip" data-tooltip="Put your mouse over rankings to see details">Rank</th>
		<th class="with-tooltip" data-tooltip="Put your mouse over progress bars to see details">Ratio</th>
		<th>Card</th>
	</tr>
	<?php
	if (!empty($fighters)) {
		$i = $rank = 1;
		$prevScore = null;
		foreach ($fighters as $key => $fighter) {
			$diff = isset($ranks->diff[$key]) ? $ranks->diff[$key] : null;
			$rank = $prevScore === $fighter->score ? $rank : $i;
			include(__DIR__ . '/elements/top-item.php');
			$prevScore = $fighter->score;
			$i++;
		}
	}
	?>
</table>

<div class="u-pullRight">
	<?php include(__DIR__ . '/elements/top-item-details.php'); ?>
</div>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>