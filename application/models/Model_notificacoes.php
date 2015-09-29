<?php

class Model_notificacoes extends CI_Model {
	
	public $table = 'notifications';
	public $table_vistas = 'notifications_views';

	function lista() {
		
		$result = $this->db->select('id, title, content, date_time')
							  ->order_by("date_time", "desc")
							  ->get($this->table);
		
		if( $result->num_rows() === 0 )
			return FALSE;
		
		else
			return $result;
		
	}

	function set($notificacao){
		
		if( $this->db->insert($this->table, $notificacao) )
			return TRUE;
		else
			return FALSE;

	}

	function delete($notificacao_id){

		if( $this->db->delete($this->table, array('id' => $notificacao_id) ) )
			return TRUE;
		else
			return FALSE;

	}

}