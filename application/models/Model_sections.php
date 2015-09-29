<?php

class Model_sections extends CI_Model {
	
	public $table_sections 	= 'dax_section';

	protected $sections = array(
						1 => 'vida-e-cidadania',
						2 => 'esportes',
						3 => 'vida-publica',
						4 => 'economia',
						5 => 'mundo',
						6 => 'caderno-g',
						7 => 'opiniao',
						8 => 'automoveis',
						9 => 'imoveis');

	function get_section_by_id($id){
		
		try {
			
			return $this->get_section('id', $id);

		} catch (Exception $e) {
			
			throw new Exception($e);

		}

	}

	function get_section_by_name($name){
		
		try {
			
			return $this->get_section('name', $name);

		} catch (Exception $e) {
			
			throw new Exception($e);

		}

	}

	/**
	 *
	 * Busca uma section por id ou name
	 *
	 * @param	string	$search 	'id' ou 'name'
	 * @param	string	$value 		deve ser o 'id' ou 'name' de uma section
	 * @return	array 	$array
	 *
	 */
	private function get_section($search, $value){

		if( !$search ) 	throw new Exception("Class: " . get_class($this) . ". Method: get_section(). Message: Parametro $search nao pode estar vazio.");
		if( !$value ) 	throw new Exception("Class: " . get_class($this) . ". Method: get_section(). Message: Parametro $value nao pode estar vazio.");

		if ( $search == 'id' ) {
				
			foreach ($this->sections as $id => $name) {

				if( $value == $id )
					return array('section_id' => $id, 'section_name' => $name);
				
			}

			return FALSE;

		} else if ( $search == 'name' ) {
			
			foreach ($this->sections as $id => $name) {

				if( $value == $name )
					return array('section_id' => $id, 'section_name' => $name);
				
			}

			return FALSE;

		} else {

			throw new Exception("Class: " . get_class($this) . ". Method: get_section(). Message: Parametro $search deve ser 'id' ou 'name'.");

		}

	}

}