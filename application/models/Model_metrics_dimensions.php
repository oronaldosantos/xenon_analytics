<?php

class Model_metrics_dimensions extends CI_Model {
	
	public $table_metric 	= 'dax_metric';
	public $table_dimension = 'dax_dimension';

	protected $metrics = array(
						1 => 'pageviews',
						2 => 'browsers',
						3 => 'time_on_page',
						4 => 'comments',
						5 => 'bounce_rate');

	protected $dimensions = array(
						1 => 'device_total',
						2 => 'source_total',
						3 => 'computer',
						4 => 'mobile',
						5 => 'tablet',
						6 => 'direct',
						7 => 'search',
						8 => 'social',
						9 => 'referrer');

	function translate_dimension($dimension){

		if( !$dimension ) throw new Exception("Class: " . get_class($this) . ". Method: translate_dimension(). Message: Parametro $dimension nao pode estar vazio.");
		
		try {

			switch ($dimension) {
				
				case 'device_total':
					$return = $this->get_dimension_by_id(1);
					break;
				
				case 'source_total':
					$return = $this->get_dimension_by_id(2);
					break;
				
				case 'Computer':
					$return = $this->get_dimension_by_id(3);
					break;
				
				case 'Mobile':
					$return = $this->get_dimension_by_id(4);
					break;
				
				case 'Tablet':
					$return = $this->get_dimension_by_id(5);
					break;
				
				case 'Direct entry':
					$return = $this->get_dimension_by_id(6);
					break;
				
				case 'Search engine':
					$return = $this->get_dimension_by_id(7);
					break;
				
				case 'Social media':
					$return = $this->get_dimension_by_id(8);
					break;
				
				case 'External referrer':
					$return = $this->get_dimension_by_id(9);
					break;
				
				default:
					throw new Exception("Class: " . get_class($this) . ". Method: translate_dimension(). Message: 'dimension' nao reconhecida");
					break;
			}

			return $return;
			
		} catch (Exception $e) {
			
			throw new Exception($e);
			
		}

	}

	function get_metric_by_id($id){
		
		try {
			
			return $this->get_metric_or_dimension('metric', 'id', $id);

		} catch (Exception $e) {
			
			throw new Exception($e);

		}

	}

	function get_metric_by_name($name){
		
		try {
			
			return $this->get_metric_or_dimension('metric', 'name', $name);

		} catch (Exception $e) {
			
			throw new Exception($e);

		}

	}

	function get_dimension_by_id($id){
		
		try {
			
			return $this->get_metric_or_dimension('dimension', 'id', $id);

		} catch (Exception $e) {
			
			throw new Exception($e);

		}

	}

	function get_dimension_by_name($name){
		
		try {
			
			return $this->get_metric_or_dimension('dimension', 'name', $name);

		} catch (Exception $e) {
			
			throw new Exception($e);

		}

	}

	/**
	 *
	 * Busca uma metrics ou dimensao por id ou name
	 *
	 * @param 	string	$type 		'metric' ou 'dimension'
	 * @param	string	$search 	'id' ou 'name'
	 * @param	string	$value 		deve ser o 'id' ou 'name' de uma 'metric' ou 'dimension'
	 * @return	array 	$array
	 *
	 */
	private function get_metric_or_dimension($type, $search, $value){

		if( !$type ) 	throw new Exception("Class: " . get_class($this) . ". Method: get_metric_or_dimension(). Message: Parametro $type nao pode estar vazio.");
		if( !$search ) 	throw new Exception("Class: " . get_class($this) . ". Method: get_metric_or_dimension(). Message: Parametro $search nao pode estar vazio.");
		if( !$value ) 	throw new Exception("Class: " . get_class($this) . ". Method: get_metric_or_dimension(). Message: Parametro $value nao pode estar vazio.");

		if( $type == 'metric' ){

			if ( $search == 'id' ) {
				
				foreach ($this->metrics as $id => $name) {

					if( $value == $id )
						return array('metric_id' => $id, 'metric_name' => $name);
					
				}

				return FALSE;

			} else if ( $search == 'name' ) {
				
				foreach ($this->metrics as $id => $name) {

					if( $value == $name )
						return array('metric_id' => $id, 'metric_name' => $name);
					
				}

				return FALSE;

			} else {

				throw new Exception("Class: " . get_class($this) . ". Method: get_metric_or_dimension(). Message: Parametro $search deve ser 'id' ou 'name'.");

			}
			
		} else if ( $type == 'dimension' ) {
			
			if ( $search == 'id' ) {
				
				foreach ($this->dimensions as $id => $name) {

					if( $value == $id )
						return array('dimension_id' => $id, 'dimension_name' => $name);
					
				}

				return FALSE;

			} else if ( $search == 'name' ) {
				
				foreach ($this->dimensions as $id => $name) {

					if( $value == $name )
						return array('dimension_id' => $id, 'dimension_name' => $name);

				}

				return FALSE;

			} else {

				throw new Exception("Class: " . get_class($this) . ". Method: get_metric_or_dimension(). Message: Parametro $search deve ser 'id' ou 'name'.");

			}

		} else {

			throw new Exception("Class: " . get_class($this) . ". Method: get_metric_or_dimension(). Message: Parametro $type deve ser 'metric' ou 'dimension'.");

		}

	}

}