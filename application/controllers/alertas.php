<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alertas extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->model('Model_alertas');
		$this->load->library('Templates');

	}

	public function index() {

		$data_header['title'] = "Alertas DAX";

		$this->templates->load("alertas/index", $data_header);

	}

}