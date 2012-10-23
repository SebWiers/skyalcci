<div class='controls'>
	<a class='top_control' <?php if ($show=='results') echo " id='on'" ;?>
		href='<?php echo site_url('/workbench/recipes/results') ?>'
		>results
	</a>
	<a class='top_control' <?php if ($show=='statistics') echo " id='on'" ;?>
		href='<?php echo site_url('/workbench/recipes/statistics') ?>'
		>statistics
	</a>
	<a class='top_control' <?php if ($show=='premix') echo " id='on'" ;?>
		href='<?php echo site_url('/workbench/recipes/premix') ?>'
		>pre-mixed
	</a>
</div>