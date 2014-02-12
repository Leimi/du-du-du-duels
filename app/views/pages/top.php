<?php if ($this->remaining > 0): ?>
<p class="warning">Currently, less than <?php echo round($this->count, ($this->count > 100 ? -2 : -1)) ?> duels occured in total. That's not much: the charts can change rather quickly.</p>
<?php endif ?>

<table class="top striped u-pullLeft">
	<tr>
		<th colspan=2 class="with-tooltip" data-tooltip="Put your mouse over rankings to see details">Rank</th>
		<th class="with-tooltip" data-tooltip="Put your mouse over progress bars to see details">Ratio</th>
		<th>Card</th>
	</tr>
	<?php
	if (!empty($this->fighters)) {
		$i = $rank = 1;
		$prevScore = null;
		foreach ($this->fighters as $key => $fighter) {
			$diff = isset($this->ranks->diff[$key]) ? $this->ranks->diff[$key] : null;
			$rank = $prevScore === $fighter->score ? $rank : $i;
			$this->insert('elements/top-item', array('rank' => $rank, 'fighter' => $fighter, 'diff' => $diff));
			$prevScore = $fighter->score;
			$i++;
		}
	}
	?>
</table>

<div class="u-pullRight">
	<?php $this->insert('elements/top-item-details'); ?>
</div>