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
		foreach ($this->fighters as $key => $fighter) {
			$fighter->diff = isset($this->ranks->diff[$fighter->id]) ? $this->ranks->diff[$fighter->id] : null;
			$this->insert('elements/top-item', array('fighter' => $fighter));
		}
	}
	?>
</table>

<div class="u-pullRight">
	<?php if (!empty($this->details)) $this->insert('elements/top-item-details', array('fighter' => $this->details)); ?>
</div>