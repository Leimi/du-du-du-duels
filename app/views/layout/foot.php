		</div>

		<script src="http://static.wowhead.com/widgets/power.js"></script>
		<!-- dev : /js/script.js -->
		<?php $js = PROD ? '/js/script.min.js?v=58797562341' :
			array('/js/script.js');
		$t = time();
		if (is_string($js)): ?>
		<script src="<?php echo $js ?>"></script>
		<?php else: foreach ($js as $script): ?>
		<script src="<?php echo $script ?>?v=<?php echo $t ?>"></script>
		<?php endforeach; endif; ?>
	</body>
</html>
