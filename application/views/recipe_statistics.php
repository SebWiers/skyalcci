<div id="show" style='padding:2em;font-weight: lighter;'>
The Alchemy Workbench uses a database that contains information about ingredients, effects, the effects of ingredients, and recipes.
Here's a summary of the information used, for independent verification.
If you want a script to replicate the database, one is avaialable at <a href="http://pastebin.com/2vKE0KMU">http://pastebin.com/2vKE0KMU</a>

<table class="stats">
	<tr><th colspan='99'>Ingredients & Effects</th></tr>
	<tr class="alt">
		<td>Ingredient Name</td><td>Effect 1</td><td>Effect 2</td><td>Effect 3</td><td>Effect 4</td>
	</tr>
<?php
$row=1;
$total=0;
foreach ($effect as $e){
	$row++;
	$total += $v;
	$alt = $row%2 ? ' class="alt" ' : '' ;
	echo "<tr$alt><td></td><td></td><td></td><td></td></tr>";
}

?>
</table>


<table class="stats">
	<tr><th colspan='99'>Efficient, Unique Recipes in Recipe Table</th></tr>
	<tr class="alt">
		<td>Number of Effects</th><td>Numer of Recipes</th>
	</tr>
<?php
$row=1;
$total=0;
foreach ($effect_counts as $k=>$v){
	$row++;
	$total += $v;
	$alt = $row%2 ? ' class="alt" ' : '' ;
	echo "<tr$alt><td>$k</td><td>$v</td></tr>";
}
$row++;
$alt = $row%2 ? ' class="alt" ' : '' ;
echo "<tr$alt><td>1+ (count of all recipes)</td><td>$total</td></tr>";
?>
</table>



</div>