<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alertas extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->library('curl');
		$this->load->library('dax_api');
		$this->load->model('Model_alertas');

	}

	public function index() {

		$data_header['title'] = "Alertas DAX";

		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("alertas/index");
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");

	}

	public function get_data($dia){

		$date_check = new DateTime();

		if( date('Y-m-d', strtotime($dia)) >= $date_check->format('Y-m-d') ){

			echo 'Dia inválido';

		} else {

			if( $this->Model_alertas->has_temp_editorias_materias($dia) ) {

				echo 'Tabela temporária já tem dados para esta data';

			} else {

				$dia_anterior = date('Y-m-d', strtotime($dia . "-1 days"));
				$dia_posterior = date('Y-m-d', strtotime($dia . "+1 days"));
				
				$date = new DateTime($dia);

				$date_formated = $date->format('Ymd');

				$url = 'https://dax-rest.comscore.com/v1/reportitems.json?startdate=' . $date_formated . '&enddate=' . $date_formated . '&itemid=11750&eventfilterid=17161&client=gazeta-do-povo&user=ronaldob&password=12345678&site=gazeta-do-povo';
				
				try {
					
					$data_from_comscore = $this->curl->get_data($url, 'json');

					foreach ($data_from_comscore->reportitems->reportitem[0]->rows->r as $r)
						$new_data[] = $r->c;

					$data = array();

					foreach ($new_data as $i => $v){

						$data[$i]['data'] 			= $date->format('Y-m-d');
						$data[$i]['editoria'] 		= $v[0];
						$data[$i]['pagina'] 	 	= $v[1];
						$data[$i]['origem'] 	 	= $v[2];
						$data[$i]['dispositivo'] 	= $v[3];
						$data[$i]['pageviews'] 		= $v[4];
						$data[$i]['browsers'] 		= $v[5];
						$data[$i]['comments'] 		= $v[6];
						$data[$i]['shares'] 	 	= $v[7];

					}

					if( $this->Model_alertas->set($data) ){

						try {
							
							$this->Model_alertas->get_top_news_from_temp($dia);

						} catch (Exception $e) {
							
							echo "Exception: " . $e->getMessage();

						}

						echo $date->format('d-m-Y');
						echo '- Sucesso<br /><br />';
						echo('<a href="http://localhost/alertas/get_data/' . $dia_anterior . '"><< ' . $dia_anterior . '</a> - - ');
						echo('<a href="http://localhost/alertas/get_data/' . $dia_posterior . '">' . $dia_posterior . ' >></a>');

					} else {
						
						echo 'Erro no banco de dados.';

					}

				} catch (Exception $e) {
					
					echo "Exception: " . $e->getMessage();

					return FALSE;

				}

			}

		}

	}

}