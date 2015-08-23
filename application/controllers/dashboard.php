<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function index() {
		
		$data_header['title'] = "Dashboard";

		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("dashboard");
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");

	}

}