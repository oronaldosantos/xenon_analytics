<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recuperacao_senha extends CI_Controller {
	
	public function index() {
		
		$data_header['title'] = "Recuperação de Senha";

		$this->load->view("layout/header", $data_header);
		$this->load->view("login/recuperacao_senha");
		$this->load->view("layout/foot");

	}

}