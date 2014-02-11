<tr>

	<td data-rank="<?php echo $rank ?>" data-score="<?php echo $fighter->score ?>" title="Score: <?php echo $fighter->score ?>"><?php echo $rank.'.' ?></td>

	<?php if (!is_null($diff)): ?>
	<td data-position="<?php echo $diff ?>" class="top-item__position with-tooltip"><?php echo Halp::rankIcon($diff) ?></td>
	<?php else: ?>
	<td></td>
	<?php endif ?>

	<td data-fights="<?php echo $fighter->fights ?>" class="with-tooltip">
		<?php $tooltip = $fighter->fights.' '.Halp::pluralize('fight', $fighter->fights).'<br>';
		$tooltip .= '<span class=\'text--cool\'>'.$fighter->wins.' ('.round($fighter->wins / $fighter->fights * 100).'%) '.Halp::pluralize('win', $fighter->wins).'</span><br>';
		if ($fighter->losts) $tooltip .= '<span class=\'text--notcool\'>'.$fighter->losts.' ('.round($fighter->losts / $fighter->fights * 100).'%) '.Halp::pluralize('defeat', $fighter->losts).'</span><br>';
		if ($fighter->draws) $tooltip .= '<span class=\'text--meh\'>'.$fighter->draws.' ('.round($fighter->draws / $fighter->fights * 100).'%) '.Halp::pluralize('draw', $fighter->draws).'</span>'; ?>
		<div class="progress top-item__ratio" data-tooltip="<?php echo $tooltip; ?>">
			<div class="progress__bar progress__bar--cool" style="width: <?php echo $fighter->wins / $fighter->fights * 100 ?>%"></div>
			<div class="progress__bar progress__bar--notcool" style="width: <?php echo $fighter->losts / $fighter->fights * 100 ?>%"></div>
			<div class="progress__bar progress__bar--meh" style="width: <?php echo $fighter->draws / $fighter->fights * 100 ?>%"></div>
		</div>
	</td>

	<td data-id="<?php echo $fighter->id ?>">
		<a style='background-image: url("<?php echo Halp::fighterImgPath($fighter, array('thumb' => true)); ?>")' class="top-item__card-preview" href="http://www.hearthhead.com/card=<?php echo $fighter->hhId ?>" target="_blank"><?php echo $fighter->name ?></a>
	</td>

</tr>