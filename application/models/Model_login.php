<?php

class Model_login extends CI_Model {
	
	// Nome da tabela
	private $tabela = 'users';

	// Obtêm o número registros da tabela no BD
	function verifica_login($email, $senha) {
		
		// Monta a Query
		$where = array( 'username' => $email, 'password' => $senha );
		$resultado = $this->db->select('id')
                		      ->where($where)
                			  ->get($this->tabela);
		
		// Retorna FALSE se o usuário não existe no banco de dados
		if( $resultado->num_rows() === 0 ) {
			
			return FALSE;

		} else {
			
			// Se o usuário existe, retorna o seu ID
			return $resultado->row(0)->id;
		
		}

	}

}