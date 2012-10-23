<?php
class Wb_settings extends CI_Model {



	private $id = 0;
	private $hash = '';
	private $settings = array();



	public function __construct(){
		parent::__construct();
		$this->settings['ing_num'] = array(2); // number of ingredients in recipes, [] or  [2] or [3] or [2,3]
		$this->settings['min_effs'] = 1; // minimum number of effects, int 1-6
		$this->settings['inventory'] = array(); // inventory ingredients, ordered array ingredient ids
		$this->settings['pref_ings'] = array(); // preffered ingredients, ordered array ingredient ids
		$this->settings['pref_ings_use'] = 1; // number of preffered ingredients to use, int 0-3
		$this->settings['pref_effs'] = array(); // preffered effects, ordered array effect ids
		$this->settings['pref_effs_use'] = 1; // number of preffered effects to use, int 0-6
		$this->settings['excl_effs'] = array(); // excluded effects, ordered array effect ids

		$sql = " SELECT id FROM ingredients WHERE quest = 0 AND game = 0";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row ){
			$this->settings['inventory'][] = $row->id;
		}
		sort($this->settings['inventory']);

		foreach($this->settings as $setting=>$value){
			if (isset($_SESSION[$setting])){
				$this->settings[$setting] = $_SESSION[$setting] ;
			} else {
				$_SESSION[$setting] = $this->settings[$setting] ;
			}
		}
		ksort($this->settings);
	}


// general & multi setting functions
	public function get(){
		return $this->settings;
	}
	public function clear($setting=false){
		switch ($setting){
			case 'ing_num':
				$this->settings[$setting] = array(2);
				break;
			case 'inventory':
			case 'pref_ings':
			case 'pref_effs':
			case 'excle_effs':
				$this->settings[$setting] = array();
				break;
			case 'min_effs':
			case 'pref_effs_use':
				$this->settings[$setting] = 1;
				break;
			case 'pref_effs_use':
				$this->settings[$setting] = 0;
				break;
			default:
				die;
		}
		$_SESSION[$setting] = $this->settings[$setting];
	}
	public function from_db($id=0){
		$max_id_q = $this->db->query( "SELECT MAX(id) AS max_id FROM settings");
		$row = $max_id_q->result();
		$maxID = $row[0]->max_id;
		if (!$id || (int)$id != $id || $id<0 || $id>$maxID){
			return false;
		}

		$query = $this->db->query(" SELECT * FROM settings WHERE id = '$id' ");
		if ($query->num_rows() < 1) return false;
		$row = $query->row_array();
		unset ($row['id']);
		unset ($row['hash']);
		foreach ($row as $setting=>$value){
			$this->settings[$setting]=json_decode($value);
			if (is_object($this->settings[$setting])){
				$this->settings[$setting] = (array)$this->settings[$setting];
			}
			$_SESSION[$setting] = $this->settings[$setting];
		}
		return true;
	}
	public function in_db(){
		foreach($this->settings as $setting){
			if (is_array($setting)){
				sort($setting);
			}
		}
		ksort($this->settings);
		$hash = sha1(json_encode($this->settings));
		$query = $this->db->query(" SELECT * FROM settings WHERE hash = '{$hash}' LIMIT 1 ");

		if ($query->num_rows() < 1) {
			// put it in the db & set $id;
			$fields = 'hash';
			$values = "'$hash'";
			foreach($this->settings as $setting=>$value){
				$fields .= ",$setting";
				$values .=  ",'" . json_encode($value) . "'";
			}
			$sql = " INSERT INTO settings ($fields) VALUES ($values) ";
			$this->db->query($sql);
			$id = $this->db->insert_id();
		} else {
			$row = $query->result();
			$id = $row[0]->id;
		}

		return $id;
	}



// ing_num
	public function add_ing_num($num){
		if (!in_array((int)$num,array(2,3))) die;

		if (!in_array($num, $this->settings['ing_num']) ){
			$this->settings['ing_num'][] = $num;
			$_SESSION['ing_num']=$this->settings['ing_num'];
		}

	}
	public function remove_ing_num($num){
		if (!in_array($num,array(2,3))) die;
		if (in_array($num, $this->settings['ing_num']) ){
			$this->settings['ing_num'] = array_diff($this->settings['ing_num'] , array($num)) ;
			$_SESSION['ing_num']=$this->settings['ing_num'];
		}
	}


// inventory
	public function default_inventory(){
		$this->settings['inventory'] = array();
		$sql = " SELECT * FROM ingredients ";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row ){
			if ($row->quest == 0 && $row->game == 0){
				$this->settings['inventory'][] = $row->id;
			} else {
				$this->remove_pref_ings($row->id);
			}
		}
		$_SESSION['inventory'] = $this->settings['inventory'];
	}
	public function add_inventory($id,$sanitized=false){
		if (!$sanitized){
			$sql = " SELECT id FROM ingredients ";
			$query = $this->db->query($sql);
			foreach ($query->result() as $row ){
				$ing_ids[] = $row->id;
			}
			if (!in_array($id,$ing_ids)){
				die();
			}
		}
		// SANITIZED
		if ( !in_array( $id, $this->settings['inventory'] ) ){
			$this->settings['inventory'][] = $id;
			$_SESSION['inventory'] = $this->settings['inventory'];
		}
	}
	public function add_inventory_all(){
		$this->settings['inventory'] = array();
		$sql = " SELECT id FROM ingredients ";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row ){
			$this->settings['inventory'][] = $row->id;
		}
		$_SESSION['inventory'] = $this->settings['inventory'];
	}
	public function remove_inventory($id){
		if (in_array($id,$this->settings['inventory'])){
			$this->remove_pref_ings($id);
			$this->settings['inventory'] =  array_diff($this->settings['inventory'], array($id));
			$_SESSION['inventory'] = $this->settings['inventory'];
		}
	}
	public function invert_inventory(){
		$sql = " SELECT id FROM ingredients ";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row ){
			$ing_ids[] = $row->id;
		}
		foreach ($this->settings['inventory'] as $id){
			$this->remove_pref_ings($id);
		}
		$this->settings['inventory'] = array_diff($ing_ids, $this->settings['inventory']);
		$_SESSION['inventory'] = $this->settings['inventory'];
	}



// pref_ings
	public function default_pref_ings(){
		$this->clear('pref_ings');
	}
	public function add_pref_ings($id){
		$sql = " SELECT id FROM ingredients ";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row ){
			$ing_ids[] = $row->id;
		}
		if (!in_array($id,$ing_ids)){
			die(); // SANITIZED
		}
		if ( !in_array( $id, $this->settings['pref_ings'] ) ){
			$this->add_inventory($id,1);
			$this->settings['pref_ings'][] = $id;
			$_SESSION['pref_ings'] = $this->settings['pref_ings'];
		}
	}
	public function add_pref_ings_all(){
		$this->settings['pref_ings'] = array();
		$sql = " SELECT id FROM ingredients ";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row ){
			$this->settings['pref_ings'][] = $row->id;
			$this->add_inventory($row->id,1);
		}
		$_SESSION['pref_ings'] = $this->settings['pref_ings'];
	}
	public function remove_pref_ings($id){
		if (in_array($id,$this->settings['pref_ings'])){
			$this->settings['pref_ings'] =  array_diff($this->settings['pref_ings'], array($id));
			$_SESSION['pref_ings'] = $this->settings['pref_ings'];
		}
	}
	public function invert_pref_ings(){
		$sql = " SELECT id FROM ingredients ";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row ){
			$ing_ids[] = $row->id;
		}
		$this->settings['pref_ings'] = array_diff($ing_ids, $this->settings['pref_ings']);
		foreach ($this->settings['pref_ings'] as $id){
			$this->add_inventory($id,1);
		}
		$_SESSION['pref_ings'] = $this->settings['pref_ings'];
	}
	public function set_pref_ings_use($num){
		$num = (int)$num;
		if (!in_array($num,array(0,1,2,3))) die;
		$this->settings['pref_ings_use'] = $num;
		$_SESSION['pref_ings_use'] = $this->settings['pref_ings_use'];
	}



// EFFECTS TAB
	public function set_min_effs($num){
		$num = (int)$num;
		if (!in_array($num,array(1,2,3,4,5,6))) die;
		$this->settings['min_effs'] = $num;
		$_SESSION['min_effs'] = $this->settings['min_effs'];
	}
	public function set_pref_effs_use($num){
		$num = (int)$num;
		if (!in_array($num,array(0,1,2,3,4,5,6))) die;
		$this->settings['pref_effs_use'] = $num;
		$_SESSION['pref_effs_use'] = $this->settings['pref_effs_use'];
	}
// EFFECTS -> PREFERRED
	public function pref_effs_invert($type){
		switch ($type){
			case 'benefit':
				$harm='0';
				break;
			case 'harm':
				$harm='1';
				break;
			default:
				$harm = "0,1";
				break;
		}
		$sql = " SELECT * FROM effects WHERE harmful IN ($harm)";
		$query = $this->db->query($sql);
		foreach ($query->result() AS $e){
			if (in_array((int)$e->id, $this->settings['pref_effs'])){
				$this->settings['pref_effs'] = array_diff($this->settings['pref_effs'],array((int)$e->id));
			} else {
				$this->settings['pref_effs'][] = (int)$e->id;
				$this->settings['excl_effs'] = array_diff($this->settings['excl_effs'],array((int)$e->id));
			}
		}
		$_SESSION['pref_effs'] = $this->settings['pref_effs'];
		$_SESSION['excl_effs'] = $this->settings['excl_effs'];
	}
	public function pref_effs_all($type){
		$this->excl_effs_clear($type);
		switch ($type){
			case 'benefit':
				$harm='0';
				break;
			case 'harm':
				$harm='1';
				break;
			default:
				$harm = "0,1";
				break;
		}
		$sql = " SELECT * FROM effects WHERE harmful IN ($harm)";
		$query = $this->db->query($sql);
		foreach ($query->result() AS $e){
			$add[] = (int)$e->id;
		}
		$this->settings['pref_effs'] = array_merge($this->settings['pref_effs'], $add);
		$this->settings['pref_effs'] = array_unique($this->settings['pref_effs']);
		$_SESSION['pref_effs'] = $this->settings['pref_effs'];
		$_SESSION['excl_effs'] = $this->settings['excl_effs'];
	}
	public function pref_effs_clear($type){
		switch ($type){
			case 'benefit':
				$harm='0';
				break;
			case 'harm':
				$harm='1';
				break;
			default:
				$harm = "0,1";
				break;
		}
		$sql = " SELECT * FROM effects WHERE harmful IN ($harm)";
		$query = $this->db->query($sql);
		foreach ($query->result() AS $e){
			$remove[] = (int)$e->id;
		}
		$this->settings['pref_effs'] = array_diff($this->settings['pref_effs'], $remove);
		$_SESSION['pref_effs'] = $this->settings['pref_effs'];
	}
// EFFECTS -> EXCLUDED
	public function excl_effs_invert($type){
		switch ($type){
			case 'benefit':
				$harm='0';
				break;
			case 'harm':
				$harm='1';
				break;
			default:
				$harm = "0,1";
				break;
		}
		$sql = " SELECT * FROM effects WHERE harmful IN ($harm)";
		$query = $this->db->query($sql);
		foreach ($query->result() AS $e){
			if (in_array((int)$e->id, $this->settings['excl_effs'])){
				$this->settings['excl_effs'] = array_diff($this->settings['excl_effs'],array((int)$e->id));
			} else {
				$this->settings['excl_effs'][] = (int)$e->id;
				$this->settings['pref_effs'] = array_diff($this->settings['pref_effs'],array((int)$e->id));
			}
		}
		$_SESSION['excl_effs'] = $this->settings['excl_effs'];
		$_SESSION['pref_effs'] = $this->settings['pref_effs'];
	}
	public function excl_effs_all($type){
		$this->pref_effs_clear($type);
		switch ($type){
			case 'benefit':
				$harm='0';
				break;
			case 'harm':
				$harm='1';
				break;
			default:
				$harm = "0,1";
				break;
		}
		$sql = " SELECT * FROM effects WHERE harmful IN ($harm)";
		$query = $this->db->query($sql);
		foreach ($query->result() AS $e){
			$add[] = (int)$e->id;
		}
		$this->settings['excl_effs'] = array_merge($this->settings['excl_effs'], $add);
		$this->settings['excl_effs'] = array_unique($this->settings['excl_effs']);
		$_SESSION['excl_effs'] = $this->settings['excl_effs'];
	}
	public function excl_effs_clear($type){
		switch ($type){
			case 'benefit':
				$harm='0';
				break;
			case 'harm':
				$harm='1';
				break;
			default:
				$harm = "0,1";
				break;
		}
		$sql = " SELECT * FROM effects WHERE harmful IN ($harm)";
		$query = $this->db->query($sql);
		foreach ($query->result() AS $e){
			$remove[] = (int)$e->id;
		}
		$this->settings['excl_effs'] = array_diff($this->settings['excl_effs'], $remove);
		$_SESSION['excl_effs'] = $this->settings['excl_effs'];
	}
	public function pref_eff_toggle($id){
		$id = (int)$id;
		$query = $this->db->query(" SELECT * FROM effects WHERE id = $id ");
		if ($query->num_rows() == 0) return false;
		if (in_array($id, $this->settings['pref_effs'])){
			$this->settings['pref_effs'] = array_diff( $this->settings['pref_effs'], array($id) );
		} else {
			$this->settings['pref_effs'][] = $id;
			$this->settings['excl_effs'] = array_diff( $this->settings['excl_effs'], array($id) );
		}
		$_SESSION['pref_effs'] = $this->settings['pref_effs'];
		$_SESSION['excl_effs'] = $this->settings['excl_effs'];
	}
	public function excl_eff_toggle($id){
		$id = (int)$id;
		$query = $this->db->query(" SELECT * FROM effects WHERE id = $id ");
		if ($query->num_rows() == 0) return false;
		if (in_array($id, $this->settings['excl_effs'])){
			$this->settings['excl_effs'] = array_diff( $this->settings['excl_effs'], array($id) );
		} else {
			$this->settings['excl_effs'][] = $id;
			$this->settings['pref_effs'] = array_diff( $this->settings['pref_effs'], array($id) );
		}
		$_SESSION['excl_effs'] = $this->settings['excl_effs'];
		$_SESSION['pref_effs'] = $this->settings['pref_effs'];
	}

// EFFECT FUNCTIONS
	public function clear_effects($page,$type){
		if ($page == 'preferred'){
			$this->pref_effs_clear($type);
		} elseif  ($page == 'excluded'){
			$this->excl_effs_clear($type);
		}
	}
	public function all_effects($page,$type){
		if ($page == 'preferred'){
			$this->pref_effs_all($type);
		} elseif  ($page == 'excluded'){
			$this->excl_effs_all($type);
		}
	}
	public function invert_effects($page,$type){
		if ($page == 'preferred'){
			$this->pref_effs_invert($type);
		} elseif  ($page == 'excluded'){
			$this->excl_effs_invert($type);
		}
	}

}
?>
