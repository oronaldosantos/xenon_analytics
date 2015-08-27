<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alertas extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->model('Model_alertas');

	}

	public function index() {

		$data_header['title'] = "Alertas DAX";

		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("alertas/index");
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");

	}

}