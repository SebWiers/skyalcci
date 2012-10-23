<div class='controls'>
	<a class='top_control' <?php if($show=='preferred') echo " id='on'"?> href='<?php echo site_url('workbench/effects/preferred')?>'
		title='  one or more checked effects will appear in all listed recipes ' >preferred</a>
	<a class='top_control' <?php if($show=='excluded') echo " id='on'"?> href='<?php echo site_url('workbench/effects/excluded')?>'
		title=' checked effects will not appear in any listed recipes ' >excluded</a>
</div>
