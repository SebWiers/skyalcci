<?php
if(is_string($ing_info)){
	echo $ing_info;
	exit;
}
?>
<strong><?php echo $ing_info->name; ?>: </strong>
<small>cost- <?php echo $ing_info->value; ?> sp  ; weight-  <?php echo $ing_info->weight; ?> lbs ; <?php echo $ing_info->game; if ($ing_info->quest) echo ' quest item'; ?>
	<div style="margin-left:2em">
<?php
foreach ($ing_info->effects as $effect){
	$harmful = $effect['harmful'] && true ? "<span class='reh'>" :  "<span class='reb'>";
	$mag_mult = $effect['mag_mult'] != 1 ? "<sup>x {$effect['mag_mult']}</sup>" : '';
	$matches = implode(', ',$effect['matches']);
	echo "<p style='text-indent: -1em;margin:0em;'>$harmful<strong>{$effect['name']}$mag_mult:</strong> value- {$effect['value']}sp</span> $matches</p>";
}
?>
	</div>
</small>
<?php
//echo '<pre>';print_r($ing_info);echo'</pre>';
?>
