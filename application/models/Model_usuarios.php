<?php

class Model_usuarios extends CI_Model {
	
	public $table = 'usuarios';

	function lista_usuarios($id = FALSE) {
		
		$this->db->select('id, nome, email, nome_usuario, telefone');
		$this->db->from($this->table);
		
		if( $id )
			$this->db->where('id', $id);

		$this->db->order_by("nome", "desc"); 

		$resultado = $this->db->get();
		
		if( $resultado->num_rows==0 )
			return FALSE;
		
		else
			return $resultado;
		
	}

	function set($user_info){
		
		if( $this->db->insert($this->table, $user_info) )
			return TRUE;
		else
			return FALSE;

	}

	function delete($user_id){

		if( $this->db->delete($this->table, array('id' => $user_id) ) )
			return TRUE;
		else
			return FALSE;

	}

}