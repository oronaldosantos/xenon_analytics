<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');

	    if( $this->session->userdata('user_logado') ){
    		redirect('/dashboard/', 'refresh');
    	}

	}

	public function index() {
		
		$data_header['title'] = "Login";

		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		$this->form_validation->set_rules('username','Nome de usuário','required|trim');
		$this->form_validation->set_rules('passwd','Senha','required|trim|md5|callback_r_valida_login');	
		
		if( $this->form_validation->run() == FALSE ) {
			
			$this->load->view("layout/header", $data_header);
			$this->load->view("login/login");
			$this->load->view("layout/foot");

		} else {
			
			redirect('/dashboard/');

		}

	}

	public function r_valida_login($senha) {

		$this->load->model('Model_login');
		
		$nome_usuario = $this->input->post('username', TRUE);
		
		$resultado = $this->Model_login->verifica_login($nome_usuario, $senha);
		
		if( $resultado == FALSE ) {
			
			$this->form_validation->set_message('r_valida_login', 'Usuário ou senha inválidos, tente novamente por favor.');
			
			return FALSE;

		} else {
			
			$dados_login = array(
							'user_logado' => TRUE, 
							'user_id' => $resultado
							);

			$this->session->set_userdata($dados_login);			

			return TRUE;

		}

	}

	public function sair(){

		$this->session->sess_destroy();
		redirect('/');

	}

}