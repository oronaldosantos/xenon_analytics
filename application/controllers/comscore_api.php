<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comscore_API extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->library('curl');
		$this->load->library('dax_api');
		$this->load->model('Model_dax');

	}

	public function index() {
		
		$this->creditos();

	}

	public function creditos(){

		$data_header['title'] = "Créditos API DAx comScore";

		$data_view['creditos'] = $this->dax_api->list_files('credits');

		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("comscore_api/creditos", $data_view);
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");

	}

	public function reports_filtros() {
		
		$data_header['title'] = "Reports e Filtros API DAx comScore";

		$data_view['funnels']				= $this->Model_dax->list_funnels();
		$data_view['funnels_update']		= $this->Model_dax->get_funnels_last_update();

		$data_view['sites'] 				= $this->Model_dax->list_sites();
		$data_view['sites_update'] 			= $this->Model_dax->get_sites_last_update();

		$data_view['event_filters'] 		= $this->Model_dax->list_event_filters();
		$data_view['event_filters_update'] 	= $this->Model_dax->get_event_filters_last_update();

		$data_view['reports'] 				= $this->Model_dax->list_reports();
		$data_view['reports_update'] 		= $this->Model_dax->get_reports_last_update();
		
		$data_view['segments'] 				= $this->Model_dax->list_segments();
		$data_view['segments_update'] 		= $this->Model_dax->get_segments_last_update();
		
		$data_view['visit_filters'] 		= $this->Model_dax->list_visit_filters();
		$data_view['visit_filters_update'] 	= $this->Model_dax->get_visit_filters_last_update();

		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("comscore_api/reports_filtros", $data_view);
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");

	}

	public function refresh_sites(){

		$data = $this->dax_api->list_files('sitelist');

		if( $this->Model_dax->refresh_sites($data) ){

			$this->session->set_flashdata('message', 'Lista de "Sites" Atualizada');
			redirect('/comscore_api/reports_filtros/');

		}

	}

	public function refresh_funnels(){

		$data = $this->dax_api->list_files('funnels');

		if( $this->Model_dax->refresh_funnels($data) ){

			$this->session->set_flashdata('message', 'Lista de "Funnels" Atualizada');
			redirect('/comscore_api/reports_filtros/');

		}

	}

	public function refresh_event_filters(){

		$data = $this->dax_api->list_files('eventfilterlist');

		if( $this->Model_dax->refresh_event_filters($data) ){

			$this->session->set_flashdata('message', 'Lista de "Event Filters" atualizada');
			redirect('/comscore_api/reports_filtros/');

		}

	}

	public function refresh_reports(){

		$data = $this->dax_api->list_files('reportitemlist');

		if( $this->Model_dax->refresh_reports($data) ){

			$this->session->set_flashdata('message', 'Lista de "Report Itens" atualizada');
			redirect('/comscore_api/reports_filtros/');

		}

	}

	public function refresh_segments(){

		$data = $this->dax_api->list_files('segmentlist');

		if( $this->Model_dax->refresh_segments($data) ){

			$this->session->set_flashdata('message', 'Lista de "Segments" atualizada');
			redirect('/comscore_api/reports_filtros/');

		}

	}

	public function refresh_visit_filters(){

		$data = $this->dax_api->list_files('visitfilterlist');

		if( $this->Model_dax->refresh_visit_filters($data) ){

			$this->session->set_flashdata('message', 'Lista de "Visit Filters" atualizada');
			redirect('/comscore_api/reports_filtros/');

		}

	}

}