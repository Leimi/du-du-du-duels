<tr class="top-item">

	<td data-rank="<?php echo $this->fighter->rank ?>" data-score="<?php echo $this->fighter->score ?>" title="Score: <?php echo $this->fighter->score ?>"><?php echo $this->fighter->rank.'.' ?></td>

	<?php if (!is_null($this->fighter->diff)): ?>
	<td data-position="<?php echo $this->fighter->diff ?>" class="top-item__position with-tooltip"><?php echo Halp::rankIcon($this->fighter->diff) ?></td>
	<?php else: ?>
	<td></td>
	<?php endif ?>

	<td data-fights="<?php echo $this->fighter->fights ?>" class="with-tooltip">
		<?php $tooltip = $this->fighter->fights.' '.Halp::pluralize('fight', $this->fighter->fights).'<br>';
		$tooltip .= '<span class=\'text--cool\'>'.$this->fighter->wins.' ('.round($this->fighter->wins / $this->fighter->fights * 100).'%) '.Halp::pluralize('win', $this->fighter->wins).'</span><br>';
		if ($this->fighter->losts) $tooltip .= '<span class=\'text--notcool\'>'.$this->fighter->losts.' ('.round($this->fighter->losts / $this->fighter->fights * 100).'%) '.Halp::pluralize('defeat', $this->fighter->losts).'</span><br>';
		if ($this->fighter->draws) $tooltip .= '<span class=\'text--meh\'>'.$this->fighter->draws.' ('.round($this->fighter->draws / $this->fighter->fights * 100).'%) '.Halp::pluralize('draw', $this->fighter->draws).'</span>'; ?>
		<div class="progress top-item__ratio" data-tooltip="<?php echo $tooltip; ?>">
			<div class="progress__bar progress__bar--cool" style="width: <?php echo $this->fighter->wins / $this->fighter->fights * 100 ?>%"></div>
			<div class="progress__bar progress__bar--notcool" style="width: <?php echo $this->fighter->losts / $this->fighter->fights * 100 ?>%"></div>
			<div class="progress__bar progress__bar--meh" style="width: <?php echo $this->fighter->draws / $this->fighter->fights * 100 ?>%"></div>
		</div>
	</td>

	<td data-name="<?php echo $this->fighter->name ?>">
		<span style='background-image: url("<?php echo Halp::fighterImgPath($this->fighter, array('thumb' => true)); ?>")' class="top-item__name">
			<a data-ajax-url="<?php echo $this->app->urlFor('details', array('id' => $this->fighter->id)) ?>" data-ajax-container=".details-container" href="<?php echo $this->app->urlFor('top', array('id' => $this->fighter->id)) ?>" class="top-item__details-link">
				<?php echo $this->fighter->name ?>
			</a>
		</span>
	</td>

</tr>