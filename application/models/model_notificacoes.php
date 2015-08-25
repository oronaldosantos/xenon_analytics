<?php

class Model_notificacoes extends CI_Model {
	
	public $table = 'notificacoes';
	public $table_vistas = 'notificacoes_vistas';

	function get_all($id = FALSE) {
		
		$this->db->select('id, titulo, conteudo, date_time');
		$this->db->from($this->table);
		
		if( $id )
			$this->db->where('id', $id);

		$this->db->order_by("date_time", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows==0 )
			return FALSE;
		
		else
			return $resultado;
		
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