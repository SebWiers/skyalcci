<div id='show'>
<h1>Welcome to Skyrim Alchemy Workbench</h1>
<h2>Skyrim Alchemy</h2>
<p class='info'>The following links provide good general information about how alchemy works in Skyrim:</p>

<p class='info'><a href='http://elderscrolls.wikia.com/wiki/Alchemy_(Skyrim)' target='_blank'>&raquo; Alchemy (Skyrim)</a>
	<em>&nbsp;&nbsp;via The Elder Scrolls Wiki</em></p>
<p class='pow info'><a href='<?php echo base_url('/assets/downloads/Uncle_Alchey.pdf') ?>' target='_blank'>&raquo; Uncle Alchey's Skyrim Alchemy Cheat Sheet</a></p>


<h2>Workbench</h2>

<span class='not_for_js'><p class='info'>It appears that your browser does not have javascript enabled, or can not handle jQuery & certain css fatures.
		This version of the Skyrim Alchmey Workbench requires javascript be enabled; an older version found <a href="http://209.46.18.232/wiers.us/skyalc/workbench.php">here does not require javascript.</a></p></span>


<p class='info'>Skyrim Alchemy Workbench gives you a list of alchemy recipes tailored to your inventory and desired effects.
	It also allows you to access these lists again in the future, by simply bookmarking a link.  Check out
	the <a class='pow' href="<?php echo site_url("/workbench/recipes/premix");?>">recipe book</a>- the links to recipes are examples, and provide a good
	jumping off point fro configuring your own settings for <a href="<?php echo site_url() ?>/workbench/effects">effects</a> and <a href="<?php echo site_url() ?>/workbench/ingredients">ingredients</a>.</p>


<h2>Instructions</h2>


<a name="ajax" id="ajax"><h3>Saving Settings</h3></a>
<p class='info'>The <a href="http://209.46.18.232/wiers.us/skyalc/workbench.php">original version of Skyrim Alchemy Workbench</a>
	required users to alter settings and then click a seperate button to save them.
	The most recent version greatly improves on this; if you have javascript enabled, any changes you make are automatically saved as you make them!
	For the technologically curious, the original used traditional forms page requests; the newer version uses AJAX to submit user inputs "on the fly".
	Additionally, changes to server side code and database design should improve performance and make adding new features much easier.
	One of the more visible results of this change is that the urls are much easier to read.
</p>


<h3>Ingredients</h3>
<p class='info'>The check-boxes on these pages allow you to select ingredients to be set as Inventory or Preferred ingredients.
<p class='info'>Hovering over an ingredient will show what effects that ingredient has, along with its cost and weight.
<p class='info'>The <a href="<?php echo site_url() ?>/workbench/ingredients/inventory">inventory</a> settings are for are precisely that.  None of the given
	recipes will include ingredients that are NOT checked on that page, allowing you to exclude items you do not have or do not wish to use up.
<p class='info'>At least as many <a href="<?php echo site_url() ?>/workbench/ingredients/prefer">Preferred Ingredients</a> as you specify will appear
	in every recipe listed. Other ingredients may also be present, if they are not Excluded.  This allows you to focus on using a few of your <a href="<?php echo site_url() ?>/workbench/ingredients/inventory">inventory</a> ingredients in all listed potions.
<span class='js_only_inline'><p class='info'>Buttons are provided above the ingredients lists to aid in selecting large
		numbers of ingredients, clearing selections, and so on.</span>
<p class='info'>Four ingredients ( Berit`s Ashes, Crimson Nirnroot, Jarrin Root, Powdered Mammoth Tuskt) are set as
	excluded from inventory by default; these ingredients are fairly rare and most often needed as"quest" items.
	Adding them to the inventory listing results in much longer recipe lists than is typically desired.
	For Crimson Nirnroot and Berit`s Ashes, this also would duplicate the exact same effects easily produced with other ingredients (Nirnroot or Bone Meal), adding little information to the results.


<h3>Effects</h3>
<p class='info'>The check-boxes allow you to select effects to be set as Preferred or Excluded via those buttons.
Checking an effect as preferred removes it from the excluded list, and vice versa.
<p class='info'>Hovering over an effect will show which ingredients have that effect.
<p class='info'><a href="<?php echo site_url() ?>/workbench/effects/exclude">Excluded Effects</a> are precisely that.  None of the given
	recipes will include any of these effects.
<p class='info'>At least as many <a href="<?php echo site_url() ?>/workbench/effects/prefer">Preferred Effects</a> as you specify will appear
	in every recipe listed. Other effects may also be present, if they are not Excluded.
<span class='js_only_inline'><p class='info'>Buttons are provided above the effects lists to aid in selecting large
		numbers of effects, clearing selections, and so on.</span>

<a name="permalink" id="permalink"><h3>Recipes</h3></a>
<p class='info'>By default, or when <a href="<?php echo site_url() ?>/workbench/recipes/settings">settings</a> is selected, this tab displays the current workbench settings
	,which summarize the input configurations found on the Ingredients and Effects tabs.
	<span class="warn">The <a href="<?php echo site_url() ?>/workbench/recipes/settings">settings</a> page also automatically displays a permalink near the bottom.  To "save" your settings, just bookmark this link.
	The link and settings are not tied to any account, so you can also share this link with others.</span>  For example, you could check all the ingredients you do not have in your inventory
	on the "excluded ingredients" page, save the settings, and then bookmark that link.  This would give you a link to settings for all the potion you can make, and serve as a basis for further refinement.
</p>
<p class='info'>Selecting <a href="<?php echo site_url() ?>/workbench/recipes/results">results</a> displays a list of recipes that correspond to the current workbench settings.
	,which summarizes the input configurations found on the Ingredients and Effects tabs.
	<span class="warn">This <a href="<?php echo site_url() ?>/workbench/recipes/results">results</a> page also automatically displays a permalink near the bottom which can be used
		to save or share the exact results page displayed
		and also reconfigures the workbench settings to match.</span>
</p>
<p class='info'>Following a link in the <a href="<?php echo site_url() ?>/workbench/recipes/premix">Recipe Book</a> fills the "Effects" and "Ingredients"
	tabs with the criteria used to those generate recipe lists; this provides a good basis for further exploration.  This works by using the permalinks mentioned above;
	feel free to create your own "recipe book" the same way!
</p>
<br/>
<p class='info'>Skyrim Alchemy Workbench lists only recipes where each ingredient contributes at least one effect the recipe would not otherwise have,
and always lists recipe ingredients in alphabetical order.  For example "Blisterwort, Wheat" is listed, but "Wheet, Blisterwort" is not, as they are the same recipe.
</p>
<p class='info'>The Skyrim Alchemy Workbench is currently configured with recipes using the 93 ingredients and 55 effects commonly referenced as existing in Skyrim as released on 11/11/11, previous to the introduction of any dlc, mods, or expansions.  If new ingredients and effects become officially available as part of core content,
I will work to expand the Workbench with new recipes, ingredients, and effects.
</p>


<h1>&nbsp</h1>
</div>