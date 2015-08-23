<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sair extends CI_Controller {
	
	public function index() {
		
		$this->load->helper(array('url'));
		
		$this->session->sess_destroy();
		
		redirect('/');

	}

}