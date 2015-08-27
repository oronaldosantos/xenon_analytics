<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {
	
	private $CI;

	public function __construct() {
	
	    parent::__construct();
	    $this->CI =& get_instance();
	
	}

	function show_404($page = '') {
        
        $heading = "404 Page Not Found";
        $message = array('Sorry, the page you requested was not found. ');

        log_message('error', '404 Page Not Found --> '.$page);
        echo $this->show_error($heading, $message, 'error_404', 404);
        exit;
    }

	function show_error($heading, $message, $template = 'error_general', $status_code = 500) {
		
		$header = array('title'=> $heading);
		$message = array('message'=> $message);
		
		echo $this->CI->load->view('layout/header', $header, TRUE);
	    echo $this->CI->load->view('layout/top_bar', '', TRUE);
	    echo $this->CI->load->view('layout/nav', '', TRUE);

	    if ( $template == 'error_general' )
	    	echo $this->CI->load->view('errors/error_general', $message, TRUE);
		
		if ( $template == 'error_404' )
	    	echo $this->CI->load->view('errors/error_404', $message, TRUE);

	    echo $this->CI->load->view('layout/footer', '', TRUE);
	    echo $this->CI->load->view('layout/foot', '', TRUE);

	}

}