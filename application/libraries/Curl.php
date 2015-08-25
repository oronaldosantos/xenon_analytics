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
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$data = curl_exec($ch);

		// Card #9

		if( empty($data) || !$data || $data = '' ){

			throw new Exception('Houve um erro na resposta');

		} else {

			curl_close($ch);
		
			if ($return_type == 'json')
				$data = json_decode($data);
		
			return $data;

		}

	}


}

/* End of file Curl.php */
/* Location: ./application/libraries/Curl.php */