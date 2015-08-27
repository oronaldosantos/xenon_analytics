<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Simple Template System
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Ronaldo Bitencourt
 */
class Templates {

	public function __construct() {
		
		$this->ci =& get_instance();

	}

	function load($view, $data_header = '', $data_view = '', $data_footer = '') {
		
		if ( $view == '' || !isset($view) ) {
			
			show_error('deu pau');

		}

		echo $this->ci->load->view('layout/header', $data_header, TRUE);
	    echo $this->ci->load->view('layout/top_bar', '', TRUE);
	    echo $this->ci->load->view('layout/nav', '', TRUE);
		echo $this->ci->load->view($view, $data_view, TRUE);
		echo $this->ci->load->view('layout/footer', $data_footer, TRUE);
	    echo $this->ci->load->view('layout/foot', '', TRUE);

	}

}

/* End of file Templates.php */
/* Location: ./application/libraries/Templates.php */