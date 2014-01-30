<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<?php if ($remaining < 0): ?>
<p class="warning">Currently, less than <?php echo round($count, ($count > 100 ? -2 : -1)) ?> duels occured in total. That's not much: the top 50 can change rather quickly.</p>
<?php endif ?>

<table class="top striped">
	<tr>
		<th>Rank</th>
		<th>Card</th>
		<th>Score</th>
		<th>Fights</th>
	</tr>
	<?php if (!empty($fighters)): foreach ($fighters as $key => $fighter):
		$diff = isset($ranks->diff[$key]) ? $ranks->diff[$key] : null;
	?>
	<tr>
		<?php if ($diff): ?>
		<td data-position="<?php echo $diff ?>"><?php echo Halp::rankIcon($diff) ?></td>
		<?php else: ?>
		<td></td>
		<?php endif ?>
		<td data-id="<?php echo $fighter->id ?>"><?php echo $fighter->name ?></td>
		<td data-score="<?php echo $fighter->score ?>"><?php echo $fighter->score ?></td>
		<td data-fights="<?php echo $fighter->fights ?>">
			<div class="progress">
				<div class="progress__bar progress__bar--win" style="width: <?php echo $fighter->wins / $fighter->fights * 100 ?>%"></div>
				<div class="progress__bar progress__bar--draw" style="width: <?php echo $fighter->draws / $fighter->fights * 100 ?>%"></div>
				<div class="progress__bar progress__bar--lost" style="width: <?php echo $fighter->losts / $fighter->fights * 100 ?>%"></div>
			</div>
		</td>
	</tr>
	<?php endforeach; endif; ?>
</table>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>