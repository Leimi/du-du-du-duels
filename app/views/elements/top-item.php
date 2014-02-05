<tr>

	<td data-rank="<?php echo $rank ?>" data-score="<?php echo $fighter->score ?>" title="Score: <?php echo $fighter->score ?>"><?php echo $rank.'.' ?></td>

	<?php if (!is_null($diff)): ?>
	<td data-position="<?php echo $diff ?>" class="top-item__position"><?php echo Halp::rankIcon($diff) ?></td>
	<?php else: ?>
	<td></td>
	<?php endif ?>

	<td data-fights="<?php echo $fighter->fights ?>">
		<div class="progress top-item__ratio" data-tooltip="
			<?php echo $fighter->fights.' '.Halp::pluralize('fight', $fighter->fights).'<br>'.
				round($fighter->wins / $fighter->fights * 100).'% wins<br>'.
				round($fighter->losts / $fighter->fights * 100).'% defeats<br>'.
				round($fighter->draws / $fighter->fights * 100).'% draws'; ?>">
			<div class="progress__bar progress__bar--cool" style="width: <?php echo $fighter->wins / $fighter->fights * 100 ?>%"></div>
			<div class="progress__bar progress__bar--notcool" style="width: <?php echo $fighter->losts / $fighter->fights * 100 ?>%"></div>
			<div class="progress__bar progress__bar--meh" style="width: <?php echo $fighter->draws / $fighter->fights * 100 ?>%"></div>
		</div>
	</td>

	<td data-id="<?php echo $fighter->id ?>">
		<a style='background-image: url("<?php echo Halp::fighterImgPath($fighter, array('thumb' => true)); ?>")' class="top-item__card-preview" href="http://www.hearthhead.com/card=<?php echo $fighter->hhId ?>" target="_blank"><?php echo $fighter->name ?></a>
	</td>

</tr>