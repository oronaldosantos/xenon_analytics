<?php

class Model_dax extends CI_Model {
	
	public $table_sites 		= 'dax_sites';
	public $table_reports 		= 'dax_reports';
	public $table_segments 		= 'dax_segments';
	public $table_event_filters = 'dax_event_filters';
	public $table_visit_filters = 'dax_visit_filters';
	public $table_funnels 		= 'dax_funnels';
	public $table_update 		= 'dax_update';

	function list_sites($site = FALSE) {
		
		$this->db->select('id, site');
		$this->db->from($this->table_sites);
		
		if( $site )
			$this->db->where('site', $site);

		$this->db->order_by("site", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows == 0 )
			return FALSE;
		
		else
			return $resultado;
		
	}

	function refresh_sites($sites){

		if(is_array($sites)){

			foreach ($sites as $row) {

				$site = array('site' => $row->name);

				$check = $this->db;
				$check->select('site');
				$check->where('site', $row->name);
				$check->from($this->table_sites);
				
				if( $check->count_all_results() > 0 ){

					$update = $this->db;
					$update->where('site', $row->name);
					$update->update($this->table_sites, $site); 

				} else {

					$insert = $this->db;
					$insert->insert($this->table_sites, $site);

				}

			}

			$this->registra_update("ci_" . $this->table_sites);

			return TRUE;

		} else {

			return FALSE;

		}

	}

	function list_funnels($dax_funnel_id = FALSE) {
		
		$this->db->select('dax_funnel_id, dax_funnel_name');
		$this->db->from($this->table_funnels);
		
		if( $dax_funnel_id )
			$this->db->where('dax_funnel_id', $dax_funnel_id);

		$this->db->order_by("dax_funnel_id", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows == 0 )
			return FALSE;
		
		else
			return $resultado;
		
	}

	function refresh_funnels($funnels){

		if(is_array($funnels)){

			foreach ($funnels as $row) {

				$funnel = array(
								'dax_funnel_id' => $row->id,
								'dax_funnel_name' => $row->name
							);

				$check = $this->db;
				$check->select('dax_funnel_id');
				$check->where('dax_funnel_id', $row->id);
				$check->from($this->table_funnels);
				
				if( $check->count_all_results() > 0 ){

					$update = $this->db;
					$update->where('dax_funnel_id', $row->id);
					$update->update($this->table_funnels, $funnel); 

				} else {

					$insert = $this->db;
					$insert->insert($this->table_funnels, $funnel);

				}

			}

			$this->registra_update("ci_" . $this->table_funnels);

			return TRUE;

		} else {

			return FALSE;

		}

	}

	function list_event_filters($dax_event_filter_id = FALSE) {
		
		$this->db->select('dax_event_filter_id, dax_event_filter_name, dax_event_filter_folder');
		$this->db->from($this->table_event_filters);
		
		if( $dax_event_filter_id )
			$this->db->where('dax_event_filter_id', $dax_event_filter_id);

		$this->db->order_by("dax_event_filter_id", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows == 0 )
			return FALSE;
		
		else
			return $resultado;
		
	}

	function refresh_event_filters($event_filters){

		if(is_array($event_filters)){

			foreach ($event_filters as $row) {

				$event = array(
								'dax_event_filter_id' => $row->id,
								'dax_event_filter_name' => $row->name,
								'dax_event_filter_folder' => $row->folder
							);

				$check = $this->db;
				$check->select('dax_event_filter_id');
				$check->where('dax_event_filter_id', $row->id);
				$check->from($this->table_event_filters);
				
				if( $check->count_all_results() > 0 ){

					$update = $this->db;
					$update->where('dax_event_filter_id', $row->id);
					$update->update($this->table_event_filters, $event); 

				} else {

					$insert = $this->db;
					$insert->insert($this->table_event_filters, $event);

				}

			}

			$this->registra_update("ci_" . $this->table_event_filters);
			
			return TRUE;

		} else {

			return FALSE;

		}

	}

	function list_reports($dax_report_id = FALSE) {
		
		$this->db->select('dax_report_id, dax_report_path');
		$this->db->from($this->table_reports);
		
		if( $dax_report_id )
			$this->db->where('dax_report_id', $dax_report_id);

		$this->db->order_by("dax_report_id", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows == 0 )
			return FALSE;
		
		else
			return $resultado;
		
	}

	function refresh_reports($reports){

		if(is_array($reports)){

			foreach ($reports as $row) {

				$report = array(
								'dax_report_id' => $row->id,
								'dax_report_path' => $row->path
							);

				$check = $this->db;
				$check->select('dax_report_id');
				$check->where('dax_report_id', $row->id);
				$check->from($this->table_reports);
				
				if( $check->count_all_results() > 0 ){

					$update = $this->db;
					$update->where('dax_report_id', $row->id);
					$update->update($this->table_reports, $report); 

				} else {

					$insert = $this->db;
					$insert->insert($this->table_reports, $report);

				}

			}

			$this->registra_update("ci_" . $this->table_reports);

			return TRUE;

		} else {

			return FALSE;

		}

	}

	function refresh_segments($segments){

		if(is_array($segments)){

			foreach ($segments as $row) {

				$segment = array(
								'dax_segment_id' => $row->{'id'},
								'dax_segment_name' => $row->{'name'}
							);

				$check = $this->db;
				$check->select('dax_segment_id');
				$check->where('dax_segment_id', $row->{'id'});
				$check->from($this->table_segments);
				
				if( $check->count_all_results() > 0 ){

					$update = $this->db;
					$update->where('dax_segment_id', $row->{'id'});
					$update->update($this->table_segments, $segment); 

				} else {

					$insert = $this->db;
					$insert->insert($this->table_segments, $segment);

				}

			}

			$this->registra_update("ci_" . $this->table_segments);

			return TRUE;

		} else {

			return FALSE;

		}

	}

	function list_segments($dax_segment_id = FALSE) {
		
		$this->db->select('dax_segment_id, dax_segment_name, dax_segment_folder');
		$this->db->from($this->table_segments);
		
		if( $dax_segment_id )
			$this->db->where('dax_segment_id', $dax_segment_id);

		$this->db->order_by("dax_segment_id", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows == 0 )
			return FALSE;
		
		else
			return $resultado;
		
	}

	function refresh_visit_filters($dax_visit_filters){

		if(is_array($dax_visit_filters)){

			foreach ($dax_visit_filters as $row) {

				$visit_filter = array(
								'dax_visit_filter_id' => $row->id,
								'dax_visit_filter_name' => $row->name,
								'dax_visit_filter_folder' => $row->folder
							);

				$check = $this->db;
				$check->select('dax_visit_filter_id');
				$check->where('dax_visit_filter_id', $row->id);
				$check->from($this->table_visit_filters);
				
				if( $check->count_all_results() > 0 ){

					$update = $this->db;
					$update->where('dax_visit_filter_id', $row->id);
					$update->update($this->table_visit_filters, $visit_filter); 

				} else {

					$insert = $this->db;
					$insert->insert($this->table_visit_filters, $visit_filter);

				}

			}

			$this->registra_update("ci_" . $this->table_visit_filters);

			return TRUE;

		} else {

			return FALSE;

		}

	}

	function list_visit_filters($dax_visit_filter_id = FALSE) {
		
		$this->db->select('dax_visit_filter_id, dax_visit_filter_name, dax_visit_filter_folder');
		$this->db->from($this->table_visit_filters);
		
		if( $dax_visit_filter_id )
			$this->db->where('dax_visit_filter_id', $dax_visit_filter_id);

		$this->db->order_by("dax_visit_filter_id", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows == 0 ){

			return FALSE;
		
		} else {
			
			return $resultado;

		}
		
	}

	protected function registra_update($table_name){

		if( $table_name != '' ){

			if( $this->db->insert($this->table_update, array( 'dax_table_updated' => $table_name )) ){

				return TRUE;

			} else {

				return FALSE;

			}

		} else {

			return FALSE;

		}

	}

	function get_reports_last_update(){

		return $this->get_last_update("ci_" . $this->table_reports);

	}

	function get_segments_last_update(){

		return $this->get_last_update("ci_" . $this->table_segments);

	}

	function get_visit_filters_last_update(){

		return $this->get_last_update("ci_" . $this->table_visit_filters);

	}

	function get_event_filters_last_update(){

		return $this->get_last_update("ci_" . $this->table_event_filters);

	}

	function get_sites_last_update(){

		return $this->get_last_update("ci_" . $this->table_sites);

	}

	function get_funnels_last_update(){

		return $this->get_last_update("ci_" . $this->table_funnels);

	}

	protected function get_last_update($table_name){

		if( $table_name != '' ){

			$this->db->select('date_time');
			$this->db->where('dax_table_updated', $table_name);
			$this->db->order_by("date_time", "desc");
			$this->db->limit(1);
			$this->db->from($this->table_update);
			
			$resultado = $this->db->get();
		
			if( $resultado->num_rows == 0 )
				return FALSE;
			
			else
				return $resultado;

		} else {

			return FALSE;

		}

	}

}