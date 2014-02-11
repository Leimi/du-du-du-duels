<div class="details">
<?php if (!empty($this->details)): ?>
	<div class="fighter fighter--details">
		<div class="fighter__img-wrapper">
			<img src="<?php echo Halp::fighterImgPath($this->details); ?>" alt="<?php echo $this->details->name ?>" class="fighter__img">
		</div>

		<div class="fighter__more-info">
			<a href="http://www.hearthhead.com/card=<?php echo $this->details->hhId ?>&amp;text" target="_blank"><?php echo $this->details->name ?></a>
		</div>
	</div>
<?php endif ?>
</div>