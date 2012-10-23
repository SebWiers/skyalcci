<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workbench extends MY_Controller {

	public function welcome($page='home')
	{
		$valid_pages = array('home','instructions','copyright');
		if ( !in_array($page,$valid_pages ) ){
			header("LOCATION: ".site_url('/workbench/welcome') ) ;
			exit;
		}
		$data['currentTab'] = 'welcome';
		$data['show'] = $page;
		$this->load->view('head',$data);
		$this->load->view("welcome_menu",$data);
		$this->load->view("welcome_$page",$data);
		$this->load->view('foot',$data);

	}

	public function recipes($page='results',$wb_id=-1)
	{
		$this->load->model('recipes');
		$valid_pages = array('premix','results','statistics');
		if ( ! in_array($page,$valid_pages) ){
			header("LOCATION: ".site_url('/workbench/recipes') ) ;
			exit;
		}
		if ( $this->wb->from_db($wb_id) ){
			$data['wb_id'] = $wb_id ;
		} else {
			$data['wb_id'] = $this->wb->in_db();
		}
		$data['currentTab'] = 'recipes';
		$data['show'] = $page;

		if ($page == 'results'){
//			if(file_exists("views/recipe_cache/{$data['wb_id']}") ){
//				$this->load->view("views/recipe_cache/{$data['wb_id']}");
//				exit;
//			}
			$wb = $this->wb->get();
			$data['wb'] = $wb;
			$data['recipes'] = $this->recipes->get_recipes($data['wb'] );
			if (is_int($data['recipes']) ) {
				$data['recipe_count'] =$data['recipes'];
			} else {
				$data['recipe_count'] = $data['recipes']['count'];
				unset($data['recipes']['count']);
				$data['inventory_names'] = $this->ings->get_ing_names($wb['inventory']);
				$data['pref_ings_names'] = $this->ings->get_ing_names($wb['pref_ings']);
				$data['pref_effs_names'] =  $this->effs->get_eff_names($wb['pref_effs']);
				$data['excl_effs_names'] =  $this->effs->get_eff_names($wb['excl_effs']);
			}
		}

		if ($page == 'statistics'){
//			if(file_exists("{$_SERVER['SCRIPT_FILENAME']}/views/statistics_cache/satistics.php") ){
//				$this->load->view("{$_SERVER['SCRIPT_FILENAME']}/views/recipe_cache/statistics.php");
//				exit;
//			}
			$data['effect_counts'] = $this->recipes->get_effect_counts();
			$data['ingredients_table'] = $this->ingredients->get_table();
			$data['wb_id'] = 'statistics';
		}

//		ob_start();
		$this->load->view('head',$data);
		$this->load->view("recipe_menu",$data);
		$this->load->view("recipe_$page",$data);
		$this->load->view('foot',$data);
//		$cachefile = "{$_SERVER['SCRIPT_FILENAME']}/views/{$page}_cache/{$data['wb_id']}.php";
//		$fp = file_put_contents ($cachefile, ob_get_contents());
//		ob_end_flush();
	}

	public function ingredients($page='inventory',$action=false)
	{
		$valid_pages = array('inventory','preferred');
		if ( ! in_array($page,$valid_pages) ){
			header("LOCATION: ".site_url('/workbench/ingredients') ) ;
			exit;
		}

		switch ($page){
			case 'preferred':
				$setting='pref_ings';
				break;
			default:
				$setting='inventory';
				break;
		}
		switch ($action){
			case 'all':
				$f= "add_{$setting}_all";
				$this->wb->$f();
				break;
			case 'clear':
				$this->wb->clear($setting);
				break;
			case 'invert':
				$f = "invert_$setting";
				$this->wb->$f();
				break;
			case 'default':
				$f= "default_$setting";
				$this->wb->$f();
				break;
			default;
				break;
		}


		$data['currentTab'] = 'ingredients';
		$data['show'] = $page;
		$data['ing_list'] = $this->ings->get_list() ;
		$data['wb'] = $this->wb->get();
		$this->load->view('head',$data);
		$this->load->view("ingredient_menu",$data);
		$this->load->view("ingredient_$page",$data);
		$this->load->view('foot',$data);
	}

	public function effects($page='preferred',$action='',$type='')
	{
		$valid_pages = array('preferred','excluded');
		if ( ! in_array($page,$valid_pages) ){
			header("LOCATION: ".site_url('/workbench/effects') ) ;
			exit;
		}

		switch($action){
			case 'clear':
				$this->wb->clear_effects($page,$type);
				break;
			case 'all':
				$this->wb->all_effects($page,$type);
				break;
			case 'invert':
				$this->wb->invert_effects($page,$type);
				break;
			default:
				break;
		}

		$data['currentTab'] = 'effects';
		$data['show'] = $page;
		$data['eoa'] = $this->effs->get_eoa() ;
		$data['wb'] = $this->wb->get();
		$this->load->view('head',$data);
		$this->load->view("effect_menu",$data);
		$this->load->view("effect_$page",$data);
		$this->load->view('foot',$data);
	}

}
