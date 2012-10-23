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
</td></tr></table>
<table class="right">
	<tr>
		<td><a class='control' onclick="return checkIngAll('inventory')"
				 href="<?php echo site_url("/workbench/ingredients/inventory/all");?>">all</a>
		<td><a class='control' onclick="return checkIngNone('inventory')"
				 href="<?php echo site_url("/workbench/ingredients/inventory/none");?>">none</a>
		<td><a class='control' onclick="return checkIngInvert('inventory')"
				 href="<?php echo site_url("/workbench/ingredients/inventory/invert");?>">invert</a>
</table>

	<div class='ing_info js_only_block' id='ing_info'>
		Ingredient Information will display when ingredients selected.<br/>
		Preferred ingredients must be marked as in inventory;
		removing them here (directly or via above controls) will also remove them from your preferred ingredients.
	</div>
<ul class='wide' id='effectList'>
<?php
//var_dump($wb);
foreach ($ing_list as $i){
	$checked = in_array($i->id, $wb['inventory']) ? "checked='checked' " : '' ;
	$xClass =  $checked ? 'checkedIng' : '' ;
	echo	"\n<li class='ingredientli $xClass' id='{$i->id}' >"
			. "&nbsp;<input $checked type='checkbox' class='check_ing' name='inventory[]' id='ii{$i->id}' value='{$i->id}' "
			. " onClick=\"ingToggle('{$i->id}','inventory')\"/>"
			."<label for='ii{$i->id}' class='ingredientlabel' "
			." onmouseover='$(\"#{$i->id}\").css(\"border-color\",\"#ddd\")' "
			." onmouseout='$(\"#{$i->id}\").css(\"border-color\",\"#222\")'>"
			. "&nbsp;{$i->name}</label></li>\n";
}
?>
</ul>
<br class='columnlistbr'>
</div>
<div class='controls left'>
<input class='control not_for_js' type="submit" value="save workbench settings" name='save_wb_settings' />
<a class='control' href='<?php echo site_url('/workbench/ingredients/inventory/default') ?>'>restore default ingredients</a>
</div>
