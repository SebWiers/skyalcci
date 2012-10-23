<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class ajax extends MY_Controller {


// SESSION HANDLERS FOR DEBUGGING
	function session_show(){
		var_dump($_SESSION);
	}

	function session_clear(){
		$_SESSION = array();
		var_dump($_SESSION);
	}


// USED ON INGREDIENTS PAGES
	function ing_num_toggle($num,$on) {
		$on = $on == 'true';
		$num = (int)$num;
		if (!$on){
			$this->wb->remove_ing_num($num);
		} else {
			$this->wb->add_ing_num($num);
		}
		//var_dump($_SESSION);
	}


// USED ON INGREDIENTS->INVENTORY
	function inventory_add($id='') {
		$ing_list = $this->ings->get_list();
		if (isset($ing_list[$id])) {
			$this->wb->add_inventory($id);
			$data['ing_info'] = $this->ings->get_ingredient_info($id);
			$this->load->view('ing_info', $data);
		} else {
			die('Error: Invalid Ingredient');
		}
		//var_dump($_SESSION);
	}

	function  inventory_remove($id=''){
		$this->wb->remove_inventory($id) ;
		$data['ing_info'] = $this->ings->get_ingredient_info($id);
		$this->load->view('ing_info', $data);
		//var_dump($_SESSION);
	}

	function  inventory_add_all() {
		$this->wb->add_inventory_all();
		//var_dump($_SESSION);
	}

	function  inventory_remove_all() {
		$this->wb->clear('inventory');
		$this->wb->clear('pref_ings');
		//var_dump($_SESSION);
	}

	function  inventory_invert() {
		$this->wb->invert_inventory();
		//var_dump($_SESSION);
	}


// USED ON INGREDIENTS->PREFFERED
	function pref_ings_add($id='') {
		$ing_list = $this->ings->get_list();
		if (isset($ing_list[$id])) {
			$this->wb->add_pref_ings($id);
			$data['ing_info'] = $this->ings->get_ingredient_info($id);
			$this->load->view('ing_info', $data);
		} else {
			die('Error: Invalid Ingredient');
		}
		//var_dump($_SESSION);
	}

	function  pref_ings_remove($id='') {
		$this->wb->remove_pref_ings($id);
		$data['ing_info'] = $this->ings->get_ingredient_info($id);
		$this->load->view('ing_info', $data);
		//var_dump($_SESSION);
	}

	function  pref_ings_add_all() {
		$this->wb->add_pref_ings_all();
		$this->wb->add_inventory_all();
		//var_dump($_SESSION);
	}

	function  pref_ings_remove_all() {
		$this->wb->clear('pref_ings');
		//var_dump($_SESSION);
	}

	function  pref_ings_invert() {
		$this->wb->invert_pref_ings();
		//var_dump($_SESSION);
	}

	function set_pref_ings_use($num=1){
		$this->wb->set_pref_ings_use($num);
		//var_dump($_SESSION);
	}




// USE ON EFFECTS
	function set_min_effs($num=1){
		$this->wb->set_min_effs($num);
		//var_dump($_SESSION);
	}
	function set_pref_effs_use($num=1){
		$this->wb->set_pref_effs_use($num);
		//var_dump($_SESSION);
	}
	function effects_pref($action='',$type='both'){
		switch($action){
			case 'invert' :
				$this->wb->pref_effs_invert($type);
				break;
			case 'all' :
				$this->wb->pref_effs_all($type);
				break;
			case 'clear' :
				$this->wb->pref_effs_clear($type);
				break;
			default:
				break;
		}
		//var_dump($_SESSION);
	}
	function effects_excl($action='',$type='both'){
		switch($action){
			case 'invert' :
				$this->wb->excl_effs_invert($type);
				break;
			case 'all' :
				$this->wb->excl_effs_all($type);
				break;
			case 'clear' :
				$this->wb->excl_effs_clear($type);
				break;
			default:
				break;
		}
		//var_dump($_SESSION);
	}
	function pref_eff_toggle($id){
		$this->wb->pref_eff_toggle($id);
		$data['eff_info'] = $this->effs->get_eff_info($id);
		$this->load->view('eff_info',$data);
	}
	function excl_eff_toggle($id){
		$this->wb->excl_eff_toggle($id);
		$data['eff_info'] = $this->effs->get_eff_info($id);
		$this->load->view('eff_info',$data);
	}


}
?>
