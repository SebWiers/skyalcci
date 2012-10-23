<div id='show'>

<div style='background-color:#444;margin:1em;display:inline-block;float:left;'>
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
<input type="hidden" name="submitted" value="preferred_effects">
</div>
<br/>
<div style='background-color:#444;margin:0em 1em 1em 1em;display:inline-block;'>
&nbsp; listed recipes will use at least
<br/>
<span class='nowrap' >
<?php for($i=0;$i<=6;$i++){
?>
&nbsp; &nbsp; <?php echo $i; ?><input type='radio' name="pref_effs_use" value="<?php echo $i; ?>"
onclick="setPrefEffsUse(<?php echo $i; ?>)"
<?php if ($i==$wb['pref_effs_use']) echo ' checked="checked" '; ?>/>
<?php
}
?>
</span>
<br>
&nbsp; of the effects below
</div>

<table  class="js_only_block right">
	<tr>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preffered/all/benefit') ?>" onclick="return checkEffAll('pref','benefit')">all benefits</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/clear/benefit') ?>" onclick="return checkEffNone('pref','benefit')">no benefits</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/invert/benefit') ?>" onclick="return checkEffInvert('pref','benefit')">invert benefits</a>
	<tr>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/all/both') ?>" onclick="return checkEffAll('pref','both')">all effects</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/clear/both') ?>" onclick="return checkEffNone('pref','both')">no effects</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/invert/both') ?>" onclick="return checkEffInvert('pref','both')">invert effects</a>
	<tr>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/all/harm') ?>" onclick="return checkEffAll('pref','harm')">all harmful</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/clear/harm') ?>" onclick="return checkEffNone('pref','harm')">no harmful</a>
		<td><a class='control' href="<?php echo site_url('workbench/effects/preferred/invert/harm') ?>" onclick="return checkEffInvert('pref','harm')">invert harmful</a>
</table>
<div class='ing_info js_only_block' id='eff_info'>
		Effect Information will display when an effect is selected.<br/>
		No effect can be both preferred and excluded;
		setting an effect as preferred (directly or via above controls) will remove it from the excluded settings.
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
		$checked = in_array((int)$e->id, $wb["pref_effs"]) ? "checked='checked' " : '' ;
		$xClass = '';
		if ( $checked && $e->harmful ) $xClass = 'checkedHarm' ;
		if ( $checked && !$e->harmful ) $xClass = 'checkedBenefit';
		echo 	"\n<li id='lep{$e->id}' class='effectli $xClass $harm' >"
				. "&nbsp;<input type='checkbox' class='check_effect check_$harm check_both' id='ep{$e->id}' name='ep[]' "
				. " onClick='effTogglePref(\"{$e->id}\")' name='ep{$e->id}' value='{$e->id}' $checked/>"
				. "<label id='elp{$e->id}' for='ep{$e->id}' "
				."	onmouseover='$(\"#lep{$e->id}\").css(\"border-color\",\"#ddd\")'
					onmouseout='$(\"#lep{$e->id}\").css(\"border-color\",\"#222\")'"
				."	>{$e->label}</label> </li> \n"
				;
	}

	?>
</ul>
<br class='columnlistbr'>

</div>
<div class='controls left'>
<input class='control not_for_js' type="submit" value="save workbench settings" />
</div>
