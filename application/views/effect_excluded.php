<div id='show'>
<?
	$eMin = empty($_SESSION['eMin']) ? 1 : (int)$_SESSION['eMin'];
	$eMinChecked = array('','','','','','','');
	$eMinChecked[$eMin]="checked='checked' ";
?>
<div style='background-color:#444;margin:1em;display:inline-block;'>
&nbsp; minimum effects for each listed recipe &nbsp;<br/>
<span class='nowrap'>
<?php for($i=1;$i<=6;$i++){
?>
&nbsp; &nbsp; <?php echo $i ?>
<input type='radio' name="min_effs" value="<?php echo $i; ?>"
 onclick="setMinEffs(<?php echo $i; ?>)"
<?php if ($i == $wb['min_effs']) echo ' checked="checked" ' ?>/>
<?php
}
?>
</span>
<input type="hidden" name="submitted" value="excluded_effects">
</div>
<br/>

<table  class="js_only_block right">
	<tr>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/all/benefit') ?>" onclick="return checkEffAll('excl','benefit')">all benefits</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/clear/benefit') ?>" onclick="return checkEffNone('excl','benefit')">no benefits</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/invert/benefit') ?>" onclick="return checkEffInvert('excl','benefit')">invert benefits</a>
	<tr>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/all/both') ?>" onclick="return checkEffAll('excl','both')">all effects</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/clear/both') ?>" onclick="return checkEffNone('excl','both')">no effects</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/invert/both') ?>" onclick="return checkEffInvert('excl','both')">invert effects</a>
	<tr>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/all/harm') ?>" onclick="return checkEffAll('excl','harm')">all harmful</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/clear/harm') ?>" onclick="return checkEffNone('excl','harm')">no harmful</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/excluded/invert/harm') ?>" onclick="return checkEffInvert('excl','harm')">invert harmful</a>
</table>
<div class='ing_info js_only_block' id='eff_info'>
		Effect Information will display when an effect is selected.<br>
		No effect can be both preferred and excluded;
		setting an effect as excluded (directly or via above controls) will remove it from the preferred settings.
</div>
<ul class='wide' id='effectList'>
	<?php
	foreach($eoa as $e){
		$harm = $e->harmful ? 'harm' : 'benefit';
		$nameArr = str_split($e->name);
		$nameArr[] = ' ';
		while ( count($nameArr)<22 ) { $nameArr[] = '&nbsp;' ; }
		$nameArr[] = ' ';
		$e->label = implode('',$nameArr);
		$checked = in_array((int)$e->id, $wb["excl_effs"]) ? "checked='checked' " : '' ;
		$xClass = '';
		if ( $checked && $e->harmful ) $xClass = 'checkedHarm' ;
		if ( $checked && !$e->harmful ) !$xClass = 'checkedBenefit';
		echo 	"\n<li id='lee{$e->id}' class='effectli $xClass $harm' >"
				."&nbsp;<input type='checkbox' class='check_effect check_$harm check_both' id='ee{$e->id}' name='ee[]' "
				." onClick='effToggleExc(\"{$e->id}\")' value='{$e->id}' name='ee{$e->id}' $checked/>"
				." <label id='ele{$e->id}' for='ee{$e->id}' "
				." onmouseover='$(\"#lee{$e->id}\").css(\"border-color\",\"#ddd\")' "
				." onmouseout='$(\"#lee{$e->id}\").css(\"border-color\",\"#222\")'"
				." >{$e->label}</label> </li>\n"  ;
	}
	?>
</ul>
<br class='columnlistbr'>


</div>
<div class='controls left'>
<input class='control' type="submit" value="save workbench settings" />
<a class='control' href='?effects_tab&show=exclude&clear_wb_settings'
					title='  clear all workbench settings (ingredients & effects) ' >clear workbench settings</a>
</div>