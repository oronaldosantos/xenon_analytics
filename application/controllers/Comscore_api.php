<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comscore_api extends CI_Controller {

	public $url_get_public_url = "http://www.gazetadopovo.com.br/eom/PortalConfig/GP-Web/jsp/publicUrl.jsp?uuid=";
	public $url_get_uuid 		= "http://www.gazetadopovo.com.br/api/getuuid.jsp?id=";
	
	public function __construct() {
		
		parent::__construct();

		$this->load->library('Templates');
		$this->load->library('Curl');
		$this->load->library('Util');
		$this->load->library('Dax_api');
		
		$this->load->model('Model_metrics_dimensions');
		$this->load->model('Model_sections');
		$this->load->model('Model_pages');
		$this->load->model('Model_facts');

		#$this->output->enable_profiler(TRUE);

	}

	public function index() {
		
		$this->creditos();

	}

	public function get_data(){

		$date 			= new DateTime();
		$now 			= $date->format('Y-m-d H:i:s');
		$now_comscore 	= $date->format('Ymd');
		
		$url = 'https://dax-rest.comscore.com/v1/reportitems.json?startdate=' . $now_comscore . '&itemid=11750&eventfilterid=17456&site=gazeta-do-povo&client=' . $this->config->item('dax_client') . '&user=' . $this->config->item('dax_username') . '&password=' . $this->config->item('dax_password');
		#echo($url);
		#die();
		#$url = 'http://localhost/application/assets/dax.json';

		try {
			
			$this->benchmark->mark('request_dax_start');
			$data_from_comscore = $this->curl->get_data($url, 'json');
			$this->benchmark->mark('request_dax_end');

			$data_from_comscore_sinitize = array();

			$this->benchmark->mark('loop_json_start');
			foreach ($data_from_comscore->reportitems->reportitem[0]->rows->r as $r) {

				$d = array();

				if ($r->c[3] != "Unknown" && $r->c[3] != "Rest" && $r->c[2] != "Rest" && $r->c[1] != "Rest" && $r->c[0] != "Total" ){
				
					$d['section'] 		= $r->c[0];
					$d['page_id'] 		= $r->c[1];

					// dimensions
					$d['source'] 	 	= $r->c[2];
					$d['device'] 		= $r->c[3];
					
					//date_time collected
					$d['date_time'] 	= $now;

					// metrics
					$d['pageviews'] 	= $r->c[4];
					$d['browsers'] 		= $r->c[5];
					$d['time_on_page'] 	= $r->c[6];
					$d['comments'] 	 	= $r->c[7];
					$d['bounce_rate'] 	= round($r->c[8] * 100, 1);

					array_push($data_from_comscore_sinitize, $d);

				}

			}
			$this->benchmark->mark('loop_json_end');

			$sections = array();

			$this->benchmark->mark('loop_section_start');
			foreach ($data_from_comscore_sinitize as $r) {

				$chave = FALSE;

				foreach ($sections as $section) {
					
					if ( $r['section'] === $section ){

						$chave = TRUE;
						break;

					}

				}

				if ( !$chave ) { 

					$sections[strtolower($r['section'])] = array();

				}

			}
			$this->benchmark->mark('loop_section_end');

			$this->benchmark->mark('loop_page_start');
			foreach ($sections as $section_index => $section) {
				
				foreach ($data_from_comscore_sinitize as $r) {

					if ( $r['section'] === $section_index ){

						$chave = FALSE;

						foreach ($section as $page_index => $page_id) {
							
							if ( $r['page_id'] === $page_index ) {
								$chave = TRUE;
								break;
							}

						}

						if ( !$chave ) {

							if ( $r['page_id'] == 'home' || $r['page_id'] == 'Total' ) {
								
								$page_id_suffix = $section_index . '-';

							} else {

								$page_id_suffix = '';

							}

							$sections[$section_index][strtolower($page_id_suffix . $r['page_id'])] = array();

						}

					}

				}

			}
			$this->benchmark->mark('loop_page_end');

			$this->benchmark->mark('loop_metrics_and_dimensions_start');

			foreach ($data_from_comscore_sinitize as $r) {

				$push['date_time'] = $r['date_time'];

				if( $r['source'] == 'Total' )
					$source = $this->Model_metrics_dimensions->translate_dimension('source_total');
				else
					$source = $this->Model_metrics_dimensions->translate_dimension($r['source']);

				if ( $r['device'] == 'Total' )
					$device = $this->Model_metrics_dimensions->translate_dimension('device_total');
				else
					$device = $this->Model_metrics_dimensions->translate_dimension($r['device']);

				$push['dimensions']['source'] 		= $source;
				$push['dimensions']['device'] 		= $device;
				
				$push['metrics']['pageviews']['definition'] 	= $this->Model_metrics_dimensions->get_metric_by_name('pageviews');
				$push['metrics']['pageviews']['value'] 			= $r['pageviews'];
				
				$push['metrics']['browsers']['definition'] 		= $this->Model_metrics_dimensions->get_metric_by_name('browsers');
				$push['metrics']['browsers']['value']	 		= $r['browsers'];

				$push['metrics']['time_on_page']['definition'] 	= $this->Model_metrics_dimensions->get_metric_by_name('time_on_page');
				$push['metrics']['time_on_page']['value']	 	= $r['time_on_page'];
				
				$push['metrics']['comments']['definition'] 		= $this->Model_metrics_dimensions->get_metric_by_name('comments');
				$push['metrics']['comments']['value']	 		= $r['comments'];

				$push['metrics']['bounce_rate']['definition'] 	= $this->Model_metrics_dimensions->get_metric_by_name('bounce_rate');
				$push['metrics']['bounce_rate']['value']	 	= $r['bounce_rate'];

				if( array_key_exists($r['section'], $sections) && array_key_exists($r['page_id'], $sections[$r['section']]) ) {

					array_push($sections[$r['section']][$r['page_id']], $push);

				}

			}
			$this->benchmark->mark('loop_metrics_and_dimensions_end');

			$facts_batch = array();

			$this->benchmark->mark('inserts_start');
			// sections
			foreach ($sections as $section => $pages) {
				
				$section_new = $this->Model_sections->get_section_by_name($section);
				$section_id  = $section_new['section_id'];

				// pages
				foreach ($pages as $page => $facts) {
					
					$new_page['id'] 				= $page;
					$new_page['ci_dax_section_id'] 	= $section_id;

					if( $this->Model_pages->get($new_page['id']) ) {

						#echo("esta pagina já existe no banco de dados");

					} else {
						
						try {

							$this->Model_pages->set($new_page);
													
						} catch (Exception $e) {

							throw new Exception($e);
							
						}

					}

					// facts
					foreach ($facts as $fact => $value) {

						$page_result = $this->Model_pages->get($new_page['id']);

						if( $page_result->num_rows > 0 ){

							$new_fact['date_time'] 	= $value['date_time'];
							$new_fact['dimension1'] = $value['dimensions']['source']['dimension_id'];
							$new_fact['dimension2'] = $value['dimensions']['device']['dimension_id'];
							
							// metrics
							foreach ($value['metrics'] as $name => $metric) {

								if( $metric['definition']['metric_id'] == 1 )
									$new_fact['pageviews'] = $metric['value'];
								
								if( $metric['definition']['metric_id'] == 2 )
									$new_fact['browsers'] = $metric['value'];
								
								if( $metric['definition']['metric_id'] == 3 )
									$new_fact['time_on_page'] = $metric['value'];
								
								if( $metric['definition']['metric_id'] == 4 )
									$new_fact['comments'] = $metric['value'];

								if( $metric['definition']['metric_id'] == 5 )
									$new_fact['bounce_rate'] = $metric['value'];

							}

							$new_fact['ci_dax_page_id'] = $new_page['id'];
							$new_fact['ci_dax_section_id'] = $new_page['ci_dax_section_id'];

							array_push( $facts_batch, $new_fact );

						}

					} // facts

				} // pages

			} // sections
			$this->benchmark->mark('inserts_end');

			$this->benchmark->mark('batch_start');
			try {

				$this->Model_facts->set($facts_batch);
										
			} catch (Exception $e) {

				throw new Exception($e);
				
			}
			$this->benchmark->mark('batch_end');

			echo("Batch data saved");

		} catch (Exception $e) {
			
			show_error($e->getMessage());

			return FALSE;

		}

	}

	public function creditos(){

		$data_header['title'] = "Créditos API DAx comScore";

		$data_view['creditos'] = $this->dax_api->list_files('credits');

		$this->templates->load("comscore/credits", $data_header, $data_view);

	}

	public function email(){

		$this->load->library('email'); // load email library
		$this->email->from('oronaldosantos@gmail.com', 'Ronaldo Bitencourt');
		$this->email->to('oronaldosantos@gmail.com');
		$this->email->subject('Teste');
		$this->email->message('Teste');
		if ($this->email->send())
			echo "Mail Sent!";
		else
			echo "There is error in sending mail!";

	}

}
