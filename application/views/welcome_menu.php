<div class='controls'>
	<a class='top_control' <?php if ($show=='home') echo " id='on'" ;?> href='<?php echo site_url('workbench/welcome/home') ?>'>home</a>
	<a class='top_control' <?php if ($show=='instructions') echo " id='on'" ;?> href='<?php echo site_url('workbench/welcome/instructions') ?>'>instructions</a>
	<a class='top_control'<?php if ($show=='copyright') echo " id='on'" ;?> href='<?php echo site_url('workbench/welcome/copyright') ?>'>copyright</a>
</div>
