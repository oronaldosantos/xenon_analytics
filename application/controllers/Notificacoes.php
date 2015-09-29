<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificacoes extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->output->enable_profiler(TRUE);

		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');
		$this->load->library('Templates');
		$this->load->model('Model_notificacoes');

}

	public function index() {
		
		$data_header['title'] = "Lista de notificações";

		$data_view['resultado'] = $this->Model_notificacoes->lista();

		if ( !$data_view['resultado'] ) {
			$this->session->set_flashdata('message_error', 'Nenhuma notificação encontrada :(');
		}
		
		$this->templates->load("notificacoes/list", $data_header, $data_view);

	}

	public function novo() {

		$data_header['title'] = "Cadastrar nova notificação";

		$this->templates->load("notificacoes/new", $data_header);

	}

	public function add() {

		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		$this->form_validation->set_rules('titulo','Título','required|trim');
		$this->form_validation->set_rules('conteudo','Conteúdo','required|trim');
		
		if( $this->form_validation->run() == FALSE ) {
			
			$this->novo();

		} else {
			
			$new = array(
			   'title'	  => $this->form_validation->set_value('titulo'),
			   'content' => $this->form_validation->set_value('conteudo'),
			   
			);
			
			if( $this->Model_notificacoes->set($new) ){

				$this->session->set_flashdata('message', 'Notificação adicionada :)');
				redirect('/notificacoes/');

			} else {
				
				show_error('Erro no banco de dados.');
				redirect('/notificacoes/new');

			}
			
		}
		
	}

	public function delete($id){

		if( $this->Model_notificacoes->delete($id) ){

			$this->session->set_flashdata('message', 'Notificação deletada');
			redirect('/notificacoes/');

		} else {
			
			show_error('Erro no banco de dados.');
			$this->novo();

		}

	}

}