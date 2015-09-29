<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->library('Templates');
	
	}

	public function index() {
		
		$data_header['title'] = "Dashboard";

		$this->templates->load("dashboard", $data_header);

	}

}
