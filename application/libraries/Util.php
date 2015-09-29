<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Util Class
 *
 * algumas coisas úteis
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Ronaldo Bitencourt
 */
class Util {

	function is_valid_date_time($date_time) {
		
		if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date_time, $matches)) {
			
			if (checkdate($matches[2], $matches[3], $matches[1])) {
				
				return TRUE;

			}

		}

		return FALSE;
	
	}

	function time_on_page_to_seconds($time){

		if( $time ) {

			$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $time);
			
			sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
			
			$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
			
			return $time_seconds;

		} else {

			return FALSE;

		}

	}

	function seconds_to_time_on_page($seconds){

		if($seconds){

			return gmdate("H:i:s", (int)$seconds);

		} else {

			return FALSE;

		}

	}


}

/* End of file Util.php */
/* Location: ./application/libraries/Curl.php */