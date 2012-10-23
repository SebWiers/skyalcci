<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('nativesession');
		$this->ses = $this->nativesession ;
		$this->load->database();
		$this->load->model('Ingredients','ings');
		$this->load->model('Effects','effs');
		$this->load->model('Wb_settings','wb');
	}
}

