<?php

class Model_pages extends CI_Model {
	
	public $table = 'dax_page';

	public function __construct() {
		
		parent::__construct();

		$this->load->model('Model_sections');

	}

	function get($page_id) {
		
		$this->db->select('id');
		$this->db->from($this->table);
		
		if( $page_id )
			$this->db->where('id', $page_id);

		$result = $this->db->get();
		
		if( $result->num_rows() === 0 )
			return FALSE;
		
		else
			return $result;
		
	}

	function get_all() {
		
		$this->db->select(' dax_page.id AS page, dax_section.title AS section');
		$this->db->from($this->table);
		$this->db->join($this->Model_sections->table_sections, 'dax_section.id = dax_page.ci_dax_section_id');

		$result = $this->db->get();
		
		if( $result->num_rows() === 0 )
			return FALSE;
		
		else
			return $result;
		
	}

	/**
	 *
	 * Armazena uma pagina no banco
	 *
	 * @param 	page(Object) $page 	Array = ( id => '', ci_dax_section_id => '')
	 * @return	boolean
	 *
	 */
	function set($page){

		if ( is_array($page) ) {
			
			if( isset( $page['id'] ) && $this->Model_sections->get_section_by_id( $page['ci_dax_section_id'] ) ) {

				if( $this->db->insert($this->table, $page) ) {

					return TRUE;

				}

			}

		}

		return FALSE;

	}

}