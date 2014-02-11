<div class="details">
<?php if (!empty($details)): ?>
	<div class="fighter fighter--details">
		<div class="fighter__img-wrapper">
			<img src="<?php echo Halp::fighterImgPath($details); ?>" alt="<?php echo $details->name ?>" class="fighter__img">
		</div>

		<div class="fighter__more-info">
			<a href="http://www.hearthhead.com/card=<?php echo $details->hhId ?>&amp;text" target="_blank"><?php echo $details->name ?></a>
		</div>
	</div>
<?php endif ?>
</div>