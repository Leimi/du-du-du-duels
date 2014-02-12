<div class="details">
<?php if (!empty($this->fighter)): ?>
	<div class="fighter fighter--details">
		<div class="fighter__img-wrapper">
			<img src="<?php echo Halp::fighterImgPath($this->fighter); ?>" alt="<?php echo $this->fighter->name ?>" class="fighter__img">
		</div>

		<div class="fighter__more-info">
			<a href="http://www.hearthhead.com/card=<?php echo $this->fighter->hhId ?>&amp;text" target="_blank"><?php echo $this->fighter->name ?></a>
		</div>

		<ul class="fighter__history">
			<?php foreach ($this->fighter->history as $history): ?>
				<li class="fighter__history-item"><?php echo Halp::fightResult($history) ?></li>
			<?php endforeach ?>
		</ul>
	</div>
<?php endif ?>
</div>