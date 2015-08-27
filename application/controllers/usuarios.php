<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');
		$this->load->library('Templates');

	}

	public function index() {
		
		$data_header['title'] = "Lista de usuários";

		$this->load->model('Model_usuarios');
		
		$data_view['resultado'] = $this->Model_usuarios->lista_usuarios();

		$this->templates->load("usuarios/lista_usuarios", $data_header, $data_view);

	}

	public function novo() {

		$data_header['title'] = "Cadastrar novo usuário";

		$this->templates->load("usuarios/cadastro_usuarios", $data_header);

	}

	public function novo_form_action() {

		$this->load->model('Model_usuarios');

		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		$this->form_validation->set_rules('nome','Nome','required|trim|xss_clean');
		$this->form_validation->set_rules('email','E-mail','required|valid_email|trim|xss_clean|is_unique['.$this->Model_usuarios->table.'.email]');
		$this->form_validation->set_rules('telefone','Telefone','required|number|trim|xss_clean');
		$this->form_validation->set_rules('username','Nome de usuário','required|trim|xss_clean|is_unique['.$this->Model_usuarios->table.'.nome_usuario]');
		
		if( $this->form_validation->run() == FALSE ) {
			
			$this->novo();

		} else {
			
			$user = array(
			   'nome' 			=> $this->form_validation->set_value('nome'),
			   'email' 			=> $this->form_validation->set_value('email'),
			   'telefone' 		=> $this->form_validation->set_value('telefone'),
			   'nome_usuario' 	=> $this->form_validation->set_value('username')
			);
			
			if( $this->Model_usuarios->set($user) ){

				$this->session->set_flashdata('message', 'Usuário adicionado :)');
				redirect('/usuarios/');

			} else {
				
				log_message('error', 'Controller: Usuarios -> delete() - Erro ao adicionar novo usuario');
				redirect('/usuarios/novo');

			}
			
		}
		
	}

	public function delete($user_id){

		$this->load->model('Model_usuarios');

		if( $this->Model_usuarios->delete($user_id) ){

			$this->session->set_flashdata('message', 'Usuário deletado');
			redirect('/usuarios/');

		} else {
			
			log_message('error', 'Controller: Usuarios -> delete() - Erro ao deletar usuario');
			show_error('Erro no banco de dados.');

		}

	}

}