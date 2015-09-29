<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');
		$this->load->library('Templates');
		$this->load->model('Model_usuarios');

	}

	public function index() {
		
		$data_header['title'] = "Lista de usuários";

		$data_view['resultado'] = $this->Model_usuarios->lista();

		$this->templates->load("usuarios/list", $data_header, $data_view);

	}

	public function novo() {

		$data_header['title'] = "Cadastrar novo usuário";

		$this->templates->load("usuarios/new", $data_header);

	}

	public function novo_form_action() {

		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		$this->form_validation->set_rules('nome','Nome','required|trim');
		$this->form_validation->set_rules('email','E-mail','required|valid_email|trim|is_unique['.$this->Model_usuarios->table.'.email]');
		$this->form_validation->set_rules('telefone','Telefone','required|trim');
		$this->form_validation->set_rules('username','Nome de usuário','required|trim|is_unique['.$this->Model_usuarios->table.'.username]');
		
		if( $this->form_validation->run() == FALSE ) {
			
			$this->novo();

		} else {
			
			$user = array(
			   'name' 			=> $this->form_validation->set_value('nome'),
			   'email' 			=> $this->form_validation->set_value('email'),
			   'phone' 		=> $this->form_validation->set_value('telefone'),
			   'username' 	=> $this->form_validation->set_value('username')
			);
			
			if( $this->Model_usuarios->set($user) ){

				$this->session->set_flashdata('message', 'Usuário adicionado :)');
				redirect('/usuarios/');

			} else {
				
				log_message('error', 'Controller: Usuarios -> delete() - Erro ao adicionar novo usuario');
				redirect('/usuarios/new');

			}
			
		}
		
	}

	public function delete($user_id){

		if( $this->Model_usuarios->delete($user_id) ){

			$this->session->set_flashdata('message', 'Usuário deletado');
			redirect('/usuarios/');

		} else {
			
			log_message('error', 'Controller: Usuarios -> delete() - Erro ao deletar usuario');
			show_error('Erro no banco de dados.');

		}

	}

}