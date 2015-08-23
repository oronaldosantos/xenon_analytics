<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificacoes extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');
		$this->load->model('Model_notificacoes');

	}

	public function index() {
		
		$data_header['title'] = "Lista de notificações";

		$dados['resultado'] = $this->Model_notificacoes->get_all();

		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("notificacoes/get_all", $dados);
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");

	}

	public function novo() {

		$data_header['title'] = "Cadastrar nova notificação";

		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("notificacoes/new");
		$this->load->view("layout/footer");
		$this->load->view("layout/foot");

	}

	public function add() {

		$this->form_validation->set_error_delimiters('<div class="erro">','</div>');
		$this->form_validation->set_rules('titulo','Título','required|trim|xss_clean');
		$this->form_validation->set_rules('conteudo','Conteúdo','required|trim|xss_clean');
		
		if( $this->form_validation->run() == FALSE ) {
			
			$this->novo();

		} else {
			
			$new = array(
			   'titulo'	  => $this->form_validation->set_value('titulo'),
			   'conteudo' => $this->form_validation->set_value('conteudo'),
			   
			);
			
			if( $this->Model_notificacoes->set($new) ){

				$this->session->set_flashdata('message', 'Notificação adicionada :)');
				redirect('/notificacoes/');

			} else {
				
				echo 'Erro no banco de dados.';
				$this->novo();

			}
			
		}
		
	}

	public function delete($id){

		if( $this->Model_notificacoes->delete($id) ){

			$this->session->set_flashdata('message', 'Notificação deletada');
			redirect('/notificacoes/');

		} else {
			
			echo 'Erro no banco de dados.';
			$this->novo();

		}

	}

}