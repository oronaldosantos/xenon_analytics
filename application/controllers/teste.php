<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teste extends MY_Controller {
	
	public function index() {
		
		$this->load->view("layout/header");
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("blank");
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");	

	}

}