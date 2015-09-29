<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        
        parent::__construct();

        // Ao inicializar o controlador, já verifica se o usuário está logado
        $this->usuario_logado();

    }

    // Método protegido, usado apenas na classe, para verificar se o usuário está logado
    protected function usuario_logado() {

    	// Carrega o Helper URL para usar o método "redirect()"
    	$this->load->helper('url');
    	
    	// Usuário não está logado? Então vai para a página de login
    	if( ! $this->session->userdata('user_logado') )
			redirect('/');
    
    }

}