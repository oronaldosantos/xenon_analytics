<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter DAX API Class
 *
 * Work with comScore DAX OneCall API
 * comScore OneCall API User Guide http://dax-files.comscore.com/digitalanalytix/US/onecall_api/help.html
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Ronaldo Bitencourt
 */
class Dax_api {

	public function __construct() {
		
		$this->ci =& get_instance();
		$this->ci->load->library('curl');

	}

	public function list_files( $type, $format = 'json' ) {
		
		if ($this->check_format($format)){

			if ($this->check_type($type)) {
				
				$url = "https://dax-rest.comscore.com/v1/" . $type . "." . $format . "?client=" . $this->ci->config->item('client', 'dax') . "&user=" . $this->ci->config->item('username', 'dax') . "&password=" . $this->ci->config->item('password', 'dax');
				
				try {

					$data = $this->ci->curl->get_data($url, 'json');

					if($type == 'sitelist'){
					
						return $data->site;

					} elseif ($type == 'reportitemlist') {
						
						return $data->ri;

					} elseif ($type == 'segmentlist') {
						
						return $data->segment;

					} elseif ($type == 'eventfilterlist') {
						
						return $data->segment;

					} elseif ($type == 'visitfilterlist') {
						
						return $data->segment;

					} elseif ($type == 'funnels') {
						
						return $data->funnel;

					} elseif ($type == 'credits') {
						
						return $data->credits[0];

					} else {

						return 'Formato inválido.';
					
					}

				} catch (Exception $e) {
					
					echo "Exception: " . $e->getMessage();

					return FALSE;

				}

			} else {

				return 'Tipo inválido. Os tipos validos são: sitelist, reportitemlist, segmentlist, eventfilterlist, visitfilterlist, funnels, credits';

			}

		} else {

			return 'Formato inválido. Os formátos validos são: json, csv, xml, pretty_xml.';

		}

	}

	protected function check_format($format){

		if(
			$format == 'json' ||
			$format == 'csv' ||
			$format == 'xml' ||
			$format == 'pretty_xml'
		  ){

			return TRUE;

		} else {

			return FALSE;

		}

	}

	protected function check_type($type){

		if(
			$type == 'sitelist' ||
			$type == 'reportitemlist' ||
			$type == 'segmentlist' ||
			$type == 'eventfilterlist' ||
			$type == 'visitfilterlist' ||
			$type == 'funnels' ||
			$type == 'credits'
		  ){

			return TRUE;

		} else {

			return FALSE;

		}

	}

}

/* End of file Dax_api.php */
/* Location: ./application/libraries/Dax_api.php */