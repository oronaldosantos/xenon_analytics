<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_facebook extends CI_Controller {
	
	public function index() {
		
		$this->load->library('facebook');

		
		$login_url = $this->facebook->login_url();
		
		echo $login_url;

	}

	public function redirect() {
		
		$this->load->library('facebook');

		$user = $this->facebook->get_user();
		
		echo("<pre>");
		print_r($user);
		echo("</pre>");

	}

}