<?php
class Effects extends CI_Model {

	function __construct(){
		parent::__construct();
	}


	function get_eoa(){
			$EOA = array();
		$effQ = "SELECT * FROM effects ORDER BY name ASC ";
		$eff_query = $this->db->query($effQ);
		foreach ($eff_query->result() as $e ) {
				$EOA[$e->id] = $e;
		}
		return $EOA;
	}


	function get_eff_info($id=-1){
		$white_list = $this->get_eoa();
		if (!isset($white_list[$id])) return "Invalid Effect.";

		$eff_sql=" SELECT * FROM effects WHERE id = $id ";
		$eff_q=$this->db->query($eff_sql);
		$eff = $eff_q->result();
		$eff = $eff[0];

		$ing_sql=" SELECT i.name, ie.mag_mult, ie.val_mod FROM ingredients i INNER JOIN ing_eff ie ON i.id = ie.ing_id WHERE ie.eff_id = $id ORDER BY i.name ";
		$ing_q=$this->db->query($ing_sql);
		foreach ($ing_q->result() as $ing){
			$eff->ingredients[] = $ing;
		}

		return $eff;

	}

	public function get_eff_names($ids){
		$ids =empty($ids) ? '-1' : implode( ',' , $ids ) ;
		$name_sql = " SELECT name FROM effects WHERE id IN ($ids) ORDER BY name ";
		//var_dump($name_sql);
		$query = $this->db->query($name_sql);
		$names = array();
		foreach ($query->result() as $row){
			$names[] = $row->name;
		}
		return $names;
	}


}
?>
