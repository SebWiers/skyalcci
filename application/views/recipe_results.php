<?php
$permalink = site_url("workbench/recipes/$wb_id");
?>
<div id="show">

	<h2><a class='acontrol' onclick="accordian('settings');" >&rAarr;Settings</a>
		<span style="font-size:62%">(<?php echo $recipe_count ; ?> recipes found for current workbench settings)</span></h2>
		<div class="settings accordion"">
		<p class='permalink'>permalink- <a href="<?php echo $permalink ?>"><?php echo $permalink ?></a></p>
		<dl>
			<dt><a class='acontrol' onclick="accordian('ingredients');" ><h4>&rAarr;Ingredients</h4></a></dt>
			<dd class="ingredients">
			<table>
				<tr>
					<td>Ingredient&nbsp;Count</td>
					<td>Recipes with <?php  echo implode(' or ',$wb['ing_num']) ?> ingredients.</td>
				</tr>
				<tr>
					<td>Inventory</td>
					<td>
						<?php
						if (empty ($inventory_names)){
							echo "None specified.<br/><strong>This will result in an empty recipe list</strong>";
						} else {
							echo "Allow use of the following ingredients : " . implode(', ',$inventory_names) .'.';
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Preferred&nbsp;Ingredients</td>
					<td>
						<?php
						echo"Require use of {$wb['pref_ings_use']} of the following ingredients: ";
						if (empty ($pref_ings_names)){
							echo "none specified. ";
						} else {
							echo implode(', ',$pref_ings_names);
						}
						if ($wb['pref_ings_use'] > count($pref_ings_names) ) echo "<br/><strong>This will result in an empty recipe list</strong>";
						?>
					</td>
				</tr>
			</table>
		</dd>
		<dt><a class='acontrol' onclick="accordian('effects');" ><h4>&rAarr;Effects</h4></a></dt>
		<dd class="effects">
			<table>
				<tr>
					<td>Effect&nbsp;Count</td>
					<td>Recipes with at least <?php echo $wb['min_effs'] ?> effects.</td>
				</tr>
				<tr>
					<td>Preferred&nbsp;Effects</td>
					<td>
						<?php
						if (empty ($pref_effs_names) || $wb['pref_effs_use'] == 0 ){
							echo "No required effects specified.";

						} else {
							echo "Require at least {$wb['pref_effs_use']} of the following effects : " . implode(', ',$pref_effs_names) .'.';
						}
						if ( $wb['pref_effs_use'] > count($pref_effs_names)  && $wb['pref_effs_use'] > $wb['min_effs'] ){
							echo "<br/><strong>This will result in an empty recipe list</strong>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Excluded&nbsp;Effects</td>
					<td>
						<?php
						echo"Forbid the use of any of the following effects: ";
						if (empty ($excl_effs_names)){
							echo "none specified.";
						} else {
							echo implode(', ',$excl_effs_names) .'.';
						}
						?>
					</td>
				</tr>
			</table>

		</dd>
		<dt><a class='acontrol' onclick="accordian('character');" ><h4>&rAarr;Character</h4></a></dt>
		<dd class="character">
			<table>
				<tr>
					<td>
						Figures given are for a character with Alchemy Skill of 100, no perks, and no enhancements.<br/>
						Some perks (such as Physician or Poisoner) may affect the relative value or even name of the results of a given recipe.<br/>
						Personalized character settings are in the works, and will resolve this!
					</td>
				</tr>
			</table>
		</dd>
		</dl>
	</div>

	<div id="recipes_div">
		<h2 >Recipes</h2>
<?php if ($recipe_count > 10000){ ?>
		<p class="info">Displaying more than 10,000 recipes is not practical.
			To gather useful results, settings should be adjusted to produce fewer recipes.
			Use less inventory or preferred effects, more excluded effects, or some preferred ingredients.
			If you want information about the database, check the statistics page.</p>
<?php } else { ?>
		<table class="recipes">
			<tr>
				<th class="left recipes">Name</th>
				<th class="left recipes">Ingredients</th>
				<th class="left recipes">Effects</th>
				<th class="right recipes">Value</th>
			</tr>
<?php
	$row=1;
	foreach($recipes as $r){
		$alt= $row%2 ? ' altr' : '';
		sort($r->ing_names);
		$ing_names= implode(', ', $r->ing_names);
		$eff_names= array();
		$e_max_val = 0;
		foreach ($r->effects_info AS $e){
			$p = $e->harmful ? 'poison' : 'potion';
			$m= '';
			if ($e->mag_mult != 1){
				$emm = trim($e->mag_mult, '0') ;
				$emm = trim($emm, '.') ;
				$m = "<sup>&times;$emm</sup>"  ;
			}
			$eff_names[$e->name] = "<span class='$p'>$e->name$m</span>";
			if ($e->value > $e_max_val){
				$e_max_val  = $e->value ;
				$r->name = ucfirst("$p of {$e->name}");
			}
		}
		ksort($eff_names);
		$eff_names = implode(", ", $eff_names);
		$potion = $r->potion ? ' potion' : '' ;
		$poison = $r->poison ? ' poison' : '' ;
		echo "<tr class='recipe$alt'><td class='recipe-name$potion$poison'>$r->name</td><td class='left ingredients'>$ing_names</td><td>$eff_names</td><td class='right value'>$r->total_value</td></tr>\n";
		$row++;
	}
}
?>
		</table>


</div>