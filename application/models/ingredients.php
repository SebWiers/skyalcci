<?php
class Ingredients extends CI_Model {

	function __construct(){
		parent::__construct();
	}


	function get_list(){
		$list = array();  # Ingredient Objects Array
		$ingSQL =
		"
		SELECT name, id
		FROM ingredients
		ORDER BY name ASC
		" ;
		$ing_query = $this->db->query($ingSQL);

		foreach ($ing_query->result() as $i){
			$list[$i->id] = $i;
		}
		return $list;
	}

	public function get_ing_names($ids){
		$ids = "'".implode( "','" , $ids )."'";
		$name_sql = " SELECT name FROM ingredients WHERE id IN ($ids) ORDER BY name ";
		$query = $this->db->query($name_sql);
		$names = array();
		foreach ($query->result() as $row){
			$names[] = $row->name;
		}
		return $names;
	}

	public function get_table(){
		$sql =
		"
		SELECT i.*, e.*, ie.*
		FROM ingredients i
		INNER JOIN ing_eff ie ON ie.ing_id = i.id
		INNER JOIN effects e ON ie.eff_id = e.id
		ORDER BY i.name, ie.eff_num
		";
	}

	function get_ingredient_info($id=-1){
		$ing_info->matches = array();
		$white_list = $this->get_list();
		if (!isset ($white_list[$id])) return "Invalid ingredient.";
		$SQL =
		"
		SELECT
		i1.*
		, g.game AS game_name
		, e1.name AS eff_name, e1.harmful, e1.val, i2.name AS m_name
		, COALESCE(ie1.mag_mult,1) AS mag_mult, COALESCE(ie1.val_mod,1) as val_mod, ie1.eff_num, ie1.eff_id
		FROM ingredients i1
		INNER JOIN games g ON i1.game=g.id
		INNER JOIN ing_eff ie1 ON i1.id = ie1.ing_id
		INNER JOIN effects e1 ON e1.id = ie1.eff_id
		INNER JOIN ingredients i2
		INNER JOIN ing_eff ie2 ON ie1.eff_id = ie2.eff_id
		AND i2.id = ie2.ing_id
		INNER JOIN effects e2 ON e2.id = ie2.eff_id
		WHERE i1.id = '$id' AND i2.id!='$id'
		ORDER BY ie1.eff_num, e2.name, i2.name
		";
		$query = $this->db->query($SQL);
		if ($query->num_rows() < 1) return "Invalid ingredient.";
		$row = $query->row();
		//var_dump($row);
		$ingredient->name = $row->name;
		$ingredient->weight = $row->weight;
		$ingredient->value = $row->value;
		$ingredient->quest = $row->quest;
		$ingredient->game = $row->game_name;
		foreach ($query->result() as $row){
			$effects[$row->eff_id]['name'] = $row->eff_name;
			$effects[$row->eff_id]['mag_mult'] = $row->mag_mult;
			$effects[$row->eff_id]['value'] = $row->val * $row->mag_mult * $row->val_mod;
			$effects[$row->eff_id]['harmful'] = $row->harmful;
			$effects[$row->eff_id]['number'] = $row->eff_num;
			$effects[$row->eff_id]['matches'][] = $row->m_name ;
		}
		$ingredient->effects = $effects;
		return $ingredient;
	}

}
?>