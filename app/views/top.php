<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/head.php'); ?>

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

<?php if (!$app->request()->isAjax()) include(__DIR__ . '/layout/foot.php'); ?>