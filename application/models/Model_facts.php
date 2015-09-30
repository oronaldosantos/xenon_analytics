<?php

class Model_facts extends CI_Model {
	
	public $table = 'dax_fact';

	public function __construct() {
		
		parent::__construct();
	
		$this->load->model('Model_metrics_dimensions');
		$this->load->model('Model_sections');
		$this->load->model('Model_pages');

	}

	/**
	 *
	 * Armazena uma pagina no banco
	 *
	 * @param 	fact(Object) $fact 	Array = ( date_time => '', value => '', ci_dax_metric_id = '', ci_dax_dimension1_id => '', ci_dax_dimension2_id => '', ci_dax_page_id => '')
	 * @return	boolean
	 *
	 */
	function set($fact){

		if ( is_array($fact) ) {
			
			if( $this->db->insert_batch($this->table, $fact) ) {

				return TRUE;

			}

		}

		return FALSE;

	}

}