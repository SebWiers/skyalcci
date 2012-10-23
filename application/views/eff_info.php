<?php
/* var_dump ($eff_info);
 * object(stdClass)#54 (6) {
	 * ["id"]=> string(1) "0"
	 * ["name"]=> string(12) "Cure Disease"
	 * ["harmful"]=> string(1) "0"
	 * ["restoration"]=> string(1) "0"
	 * ["val"]=> string(2) "21"
	 * ["ingredients"]=> array(4) {
	 *		[0]=> object(stdClass)#52 (3) { ["name"]=> string(20) "Charred Skeever Hide" ["mag_mult"]=> NULL ["val_mod"]=> string(4) "0.36" }
	 *		[1]=> object(stdClass)#51 (3) { ["name"]=> string(13) "Hawk Feathers" ["mag_mult"]=> NULL ["val_mod"]=> string(4) "0.36" }
	 *		[2]=> object(stdClass)#50 (3) { ["name"]=> string(14) "Mudcrab Chitin" ["mag_mult"]=> NULL ["val_mod"]=> NULL }
	 *		[3]=> object(stdClass)#49 (3) { ["name"]=> string(12) "Vampire Dust" ["mag_mult"]=> NULL ["val_mod"]=> NULL }
	 * }
 * }
 */
?>
<strong><?php echo $eff_info->name ?>:</strong>
<small>value- <?php echo $eff_info->val ?>; ingredients-
<?php
$ings = array();
foreach ($eff_info->ingredients as $i){
	$m = '';
	$v = '';
	if ($i->mag_mult){
		$m = trim($i->mag_mult,'0');
		$m = "<sup>&times;". trim($m,'.') . "</sup>";
	}
	if ($i->val_mod){
		$v = trim($i->val_mod,'0');
		$v = "<sub>&times;". trim($v,'.') . "</sub>";
	}
	$ings[] = $i->name . $m . $v ;
}
echo implode(', ',$ings);
?>
</small>

