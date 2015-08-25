<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Curl Class
 *
 * Work with remote servers via cURL much easier than using the native PHP bindings.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Ronaldo Bitencourt
 */
class Curl {

	public function get_data($url, $return_type = FALSE) {
		
		$ch 		= curl_init();
		$timeout 	= 5;
	
		curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		$data 		= curl_exec($ch);
		$http_code 	= curl_getinfo($ch, CURLINFO_HTTP_CODE);
    	
    	curl_close($ch);

		if( $http_code == 200 ){

			if ($return_type == 'json')
				$data = json_decode($data);

			return $data;

		} else {

			throw new Exception('Erro [' . $http_code . ']:' . $data);

		}

	}


}

/* End of file Curl.php */
/* Location: ./application/libraries/Curl.php */