<div id='show'>

<table><tr><td>
<div style='background-color:#444;margin:0em 1em;display:inline-block;'>
<span class='nowrap'>
&nbsp; &nbsp; 2<input type='checkbox' id="ing_num2" name="ing_num[]" value=2 checked="checked" disabled="disabled"/>
&nbsp; &nbsp; 3<input type='checkbox' id="ing_num3" name="ing_num[]" value=3 onclick="ing_num_toggle(3)"
<?echo isset($wb['ing_num']) && in_array(3,$wb['ing_num']) ? 'checked="checked"' : '' ; ?>/>
</span>
<br/>&nbsp; ingredients in recipes &nbsp
</div>
</td><td>
<div style='background-color:#444;margin:0em 1em;display:inline-block;'>
&nbsp; listed recipes will use at least
<br/>
<span class='nowrap' >
<?php
for ($i=0;$i<=3;$i++){
?>
	&nbsp; &nbsp;
	<?php echo $i?>
	<input type="radio" name="pref_ings_use"
	value="<?php echo $i;?>"
	<?php if ($wb['pref_ings_use'] === $i) echo 'checked="checked" '; ?>
	onclick="setPrefIngsUse(<?php echo $i; ?>)"
	/>
<?php
}
?>
<br>
&nbsp; of the following ingredients
</div>
</td></tr></table>
<table class="right">
	<tr>
		<td><a class='control' onclick="return checkIngAll('pref_ings')"
				 href="<?php echo site_url("/workbench/ingredients/preferred/all")?>">all</a>
		<td><a class='control' onclick="return checkIngNone('pref_ings')"
				 href="<?php echo site_url("/workbench/ingredients/preferred/clear")?>">none</a>
		<td><a class='control' onclick="return checkIngInvert('pref_ings')"
				 href="<?php echo site_url("/workbench/ingredients/preferred/invert")?>">invert</a>
</table>
	<div class='ing_info js_only_block' id='ing_info'>
		Ingredient Information will display when ingredients selected.
		Preferred ingredients must be marked as in inventory;
		adding them here (directly or via above controls) will also add them to your inventory.
	</div>
<ul class='wide' id='effectList'>
<?php
foreach ($ing_list as $i){
	$checked =  in_array( $i->id , $wb['pref_ings'] )  ? "checked='checked' " : '' ;
	$xClass =  $checked ? 'checkedIng' : ''  ;
	echo	"\n<li class='ingredientli $xClass' id='{$i->id}' >"
	. "&nbsp;<input $checked type='checkbox' class='check_ing'  name='pref_ings[]' id='ip{$i->id}' value='{$i->id}' "
	. " onClick=\"ingToggle('{$i->id}','pref_ings')\"/>"
	."<label for='ip{$i->id}' class='ingredientlabel' "
	." onmouseover='$(\"#{$i->id}\").css(\"border-color\",\"#ddd\")' "
	." onmouseout='$(\"#{$i->id}\").css(\"border-color\",\"#222\")'>"
	. "&nbsp;{$i->name}</label></li>\n";
}
?>
</ul>
<br class='columnlistbr'>
</div>
<div class='controls left'>
<input class='control not_for_js' type="submit" value="save workbench settings" name='wb_settings'/>
</div>
