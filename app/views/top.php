<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

<?php if ($remaining < 0): ?>

<table class="top striped">
	<tr>
		<th>Card</th>
		<th>Score</th>
		<th>Wins</th>
		<th>Losts</th>
		<th>Draws</th>
	</tr>
	<?php if (!empty($fighters)): foreach ($fighters as $fighter): ?>
	<tr>
		<td><?php echo $fighter->name ?></td>
		<td data-score="<?php echo $fighter->score ?>"><?php echo $fighter->score ?></td>
		<td data-wins="<?php echo $fighter->wins ?>"><?php echo $fighter->wins ?></td>
		<td data-losts="<?php echo $fighter->losts ?>"><?php echo $fighter->losts ?></td>
		<td data-draws="<?php echo $fighter->draws ?>"><?php echo $fighter->draws ?></td>
	</tr>
	<?php endforeach; endif; ?>
</table>

<?php else: ?>

<h2>Not enough votes!</h2>

<p>Showing some ranking is kinda useless without a decent amount of votes… Vote more or come back later!</p>

<p>Around <?php echo round($remaining, ($remaining > 100 ? -2 : -1)) ?> votes remaining until rankings appear.</p>

<?php endif ?>

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>