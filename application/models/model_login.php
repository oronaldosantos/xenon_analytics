<?php

class Model_login extends CI_Model {
	
	// Nome da tabela
	private $tabela = 'usuarios';

	// Obtêm o número registros da tabela no BD
	function verifica_login($email, $senha) {
		
		// Monta a Query
		$this->db->select('id');
		$this->db->from($this->tabela);
		
		$where = array( 'nome_usuario' => $email, 'senha' => $senha );
		$this->db->where($where);
		
		$resultado = $this->db->get();
		
		// Retorna FALSE se o usuário não existe no banco de dados
		
		if( $resultado->num_rows==0 ) {
			
			return FALSE;
		} else {
			
			// Se o usuário existe, retorna o seu ID
			return $resultado->row(0)->id;
		
		}

	}

}