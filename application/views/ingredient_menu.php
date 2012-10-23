<div class='controls'>
	<a class='top_control'<?php if( $show=='inventory') echo " id='on'";?> href='<?php echo site_url('/workbench/ingredients/inventory') ?>'
		title=' only checked ingredients will appear in listed recipes ' >inventory</a>
	<a class='top_control' <?php if( $show=='preferred') echo " id='on'";?> href='<?php echo site_url('/workbench/ingredients/preferred') ?>'
		title='  one or more checked ingredients will appear in all listed recipes ' >preferred</a>
</div>
