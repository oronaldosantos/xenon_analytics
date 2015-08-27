<?php

class Model_alertas extends CI_Model {
	
	public $table_temp 		= 'temp_editorias_materias';
	public $table_destino 	= 'ci_top_news_by_day_by_editoria';

	function lista($date = '') {
		
		$editorias = "(
			   `editoria` = 'viver-bem'
			OR `editoria` = 'vida-publica'
			OR `editoria` = 'vida-e-cidadania'
			OR `editoria` = 'opiniao'
			OR `editoria` = 'mundo'
			OR `editoria` = 'imoveis'
			OR `editoria` = 'haus'
			OR `editoria` = 'esportes'
			OR `editoria` = 'economia'
			OR `editoria` = 'caderno-g'
			OR `editoria` = 'bom-gourmet'
			OR `editoria` = 'automoveis'
			OR `editoria` = 'agronegocios'
			OR `editoria` = 'total')";

		$this->db->select("DATE_FORMAT(data, '%Y-%m-%d') AS data, editoria, pageviews, browsers", FALSE)
				 ->from($this->table_temp)
				 ->where('dispositivo', 'total')
				 ->where('origem', 'total')
				 ->where('pagina', 'total')
				 ->where($editorias);
		
		if( $date != 0 )
			$this->db->where('data', $date);

		$this->db->order_by('editoria DESC');
		$this->db->distinct('data, editoria');

		$data = $this->db->get();

		if( $data->num_rows == 0 )
			return FALSE;
		
		else
			return $data;
		
	}

	function set($data){

		if( $this->db->insert_batch($this->table_temp, $data) )
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

	function get_top_news_from_temp($dia){

		$q_tabela_temp = $this->db;

		$q_tabela_temp->select("DATE_FORMAT(data, '%Y-%m-%d') AS data, editoria, pagina, pageviews, browsers, comments, shares", FALSE)
			->from($this->table_temp)
			->where('pagina !=', 'Rest')
			->where('pagina !=', 'Total')
			->where('dispositivo', 'total')
			->where('origem', 'total')
			->where('data', $dia)
			->limit(30)
			->order_by('pageviews DESC, browsers DESC, comments DESC, shares DESC');

		// pega dados da tabela temporaria
		$d_tabela_temp = $q_tabela_temp->get();

		if( $d_tabela_temp->num_rows == 0 ){
			
			throw new Exception('Tabela:' . $table_temp . ', sem dados para esta data');
		
		} else {

			$dados_tabela_temp = $d_tabela_temp->result_array();

			// monta sql para verificacao da tabela de destino
			$q_tabela_destino_check = $this->db;
			$q_tabela_destino_check->select("data", FALSE)
				->from($this->table_destino)
				->where('data', $dia);
			
			$d_tabela_destino_check = $q_tabela_destino_check->get();

			// verifica se a tabela destino já possui dados do mesmo dia
			if( $d_tabela_destino_check->num_rows == 0 ){
				
				// popula a tabela destino com os dados da tabela temporaria
				$q_tabela_destino_insert = $this->db;
				$q_tabela_destino_insert->insert_batch($this->table_destino, $dados_tabela_temp);

				// monta sql para checar se os dados foram inseridos corretamente
				$q_tabela_destino_retorno = $this->db;
				$q_tabela_destino_retorno->select("data, pagina", FALSE)
				->from($this->table_destino)
				->where('data', $dia);
			
				$d_tabela_destino_retorno = $q_tabela_destino_retorno->get();

				// verifica se a tabela destino está com os dados corretos
				if( $d_tabela_destino_retorno->num_rows == 0 ){

					throw new Exception('Tabela:\'' . $this->table_destino . '\' não encontrou registros para essa data');

				} else {

					return TRUE;

					// Card #10

				}

			} else {
				
				throw new Exception('Tabela:' . $this->table_destino . ', já possui registros com essa data');

			}

		}

	}

	function popula_disp_origem_from_temp($dia){

		$q_tabela_destino_retorno = $this->db;
		$q_tabela_destino_retorno->select("data, pagina", FALSE)
		->from($this->table_destino)
		->where('data', $dia);
	
		$d_tabela_destino_retorno = $q_tabela_destino_retorno->get();

		if( $d_tabela_destino_retorno->num_rows == 0 ){

			echo 'Sem registros para essa data';

		} else {

			#echo('<pre>');
			#print_r($d_tabela_destino_retorno->result());
			#echo('</pre>');

			$pagina = array();

			foreach ($d_tabela_destino_retorno->result() as $k => $v) {
				
				$pagina[$k]['pagina'] = $v->pagina;
				$pagina[$k]['dia'] = $dia;

				// dispositivos

				$q_device_desktop = $this->db;
				$q_device_desktop->select("pagina, DATE_FORMAT(data, '%Y-%m-%d') AS data", FALSE)
								 ->select_sum('pageviews')
								 ->select_sum('browsers')
								 ->select_sum('comments')
								 ->select_sum('shares')
								 ->from($this->table_temp)
					 			 ->where('pagina', $v->pagina)
								 ->where('data', $dia)
								 ->where('origem', 'Total')
								 ->where("(`dispositivo` = 'Computer' OR `dispositivo` = 'Unknown' OR `dispositivo` = 'Big screen' OR `dispositivo` = 'Unspecified')")
								 ->limit(10);

				$d_device_desktop = $q_device_desktop->get();
				$r_device_desktop = $d_device_desktop->result();
				$pagina[$k]['desktop']['pageviews'] = $r_device_desktop[0]->pageviews;
				$pagina[$k]['desktop']['browsers'] = $r_device_desktop[0]->browsers;
				$pagina[$k]['desktop']['comments'] = $r_device_desktop[0]->comments;
				$pagina[$k]['desktop']['shares'] = $r_device_desktop[0]->shares;

				$q_device_mobile = $this->db;
				$q_device_mobile->select("pagina, DATE_FORMAT(data, '%Y-%m-%d') AS data", FALSE)
								 ->select_sum('pageviews')
								 ->select_sum('browsers')
								 ->select_sum('comments')
								 ->select_sum('shares')
								 ->from($this->table_temp)
					 			 ->where('pagina', $v->pagina)
								 ->where('data', $dia)
								 ->where('origem', 'Total')
								 ->where("(`dispositivo` = 'Mobile' OR `dispositivo` = 'Tablet')")
								 ->limit(10);

				$d_device_mobile = $q_device_mobile->get();
				$r_device_mobile = $d_device_mobile->result();
				$pagina[$k]['mobile']['pageviews'] = $r_device_mobile[0]->pageviews;
				$pagina[$k]['mobile']['browsers'] = $r_device_mobile[0]->browsers;
				$pagina[$k]['mobile']['comments'] = $r_device_mobile[0]->comments;
				$pagina[$k]['mobile']['shares'] = $r_device_mobile[0]->shares;

				// origens de tráfego

				$q_source_direct = $this->db;
				$q_source_direct->select("pagina, DATE_FORMAT(data, '%Y-%m-%d') AS data", FALSE)
								 ->select_sum('pageviews')
								 ->select_sum('browsers')
								 ->select_sum('comments')
								 ->select_sum('shares')
								 ->from($this->table_temp)
					 			 ->where('pagina', $v->pagina)
								 ->where('data', $dia)
								 ->where('dispositivo', 'Total')
								 ->where('origem', 'Direct entry')
								 ->limit(10);

				$d_source_direct = $q_source_direct->get();
				$r_source_direct = $d_source_direct->result();
				$pagina[$k]['direct']['pageviews'] = $r_source_direct[0]->pageviews;
				$pagina[$k]['direct']['browsers'] = $r_source_direct[0]->browsers;
				$pagina[$k]['direct']['comments'] = $r_source_direct[0]->comments;
				$pagina[$k]['direct']['shares'] = $r_source_direct[0]->shares;

				$q_source_search = $this->db;
				$q_source_search->select("pagina, DATE_FORMAT(data, '%Y-%m-%d') AS data", FALSE)
								 ->select_sum('pageviews')
								 ->select_sum('browsers')
								 ->select_sum('comments')
								 ->select_sum('shares')
								 ->from($this->table_temp)
					 			 ->where('pagina', $v->pagina)
								 ->where('data', $dia)
								 ->where('dispositivo', 'Total')
								 ->where('origem', 'Search engine')
								 ->limit(10);

				$d_source_search = $q_source_search->get();
				$r_source_search = $d_source_search->result();
				$pagina[$k]['search']['pageviews'] = $r_source_search[0]->pageviews;
				$pagina[$k]['search']['browsers'] = $r_source_search[0]->browsers;
				$pagina[$k]['search']['comments'] = $r_source_search[0]->comments;
				$pagina[$k]['search']['shares'] = $r_source_search[0]->shares;

				$q_source_social = $this->db;
				$q_source_social->select("pagina, DATE_FORMAT(data, '%Y-%m-%d') AS data", FALSE)
								 ->select_sum('pageviews')
								 ->select_sum('browsers')
								 ->select_sum('comments')
								 ->select_sum('shares')
								 ->from($this->table_temp)
					 			 ->where('pagina', $v->pagina)
								 ->where('data', $dia)
								 ->where('dispositivo', 'Total')
								 ->where('origem', 'Social media')
								 ->limit(10);

				$d_source_social = $q_source_social->get();
				$r_source_social = $d_source_social->result();
				$pagina[$k]['social']['pageviews'] = $r_source_social[0]->pageviews;
				$pagina[$k]['social']['browsers'] = $r_source_social[0]->browsers;
				$pagina[$k]['social']['comments'] = $r_source_social[0]->comments;
				$pagina[$k]['social']['shares'] = $r_source_social[0]->shares;

				$q_source_referrer = $this->db;
				$q_source_referrer->select("pagina, DATE_FORMAT(data, '%Y-%m-%d') AS data", FALSE)
								 ->select_sum('pageviews')
								 ->select_sum('browsers')
								 ->select_sum('comments')
								 ->select_sum('shares')
								 ->from($this->table_temp)
					 			 ->where('pagina', $v->pagina)
								 ->where('data', $dia)
								 ->where('dispositivo', 'Total')
								 ->where('origem', 'External referrer')
								 ->limit(10);

				$d_source_referrer = $q_source_referrer->get();
				$r_source_referrer = $d_source_referrer->result();
				$pagina[$k]['referrer']['pageviews'] = $r_source_referrer[0]->pageviews;
				$pagina[$k]['referrer']['browsers'] = $r_source_referrer[0]->browsers;
				$pagina[$k]['referrer']['comments'] = $r_source_referrer[0]->comments;
				$pagina[$k]['referrer']['shares'] = $r_source_referrer[0]->shares;

				// totais e percentuais

				$q_total = $this->db;
				$q_total->select("pagina, DATE_FORMAT(data, '%Y-%m-%d') AS data", FALSE)
						->select_sum('pageviews')
						->select_sum('browsers')
						->select_sum('comments')
						->select_sum('shares')
						->from($this->table_temp)
					 	->where('pagina', $v->pagina)
						->where('data', $dia)
						->where('origem', 'Total')
						->where('dispositivo', 'Total')
						->limit(10);

				$d_total = $q_total->get();
				$r_total = $d_total->result();
				$pagina[$k]['total']['pageviews'] = $r_total[0]->pageviews;
				$pagina[$k]['total']['browsers'] = $r_total[0]->browsers;
				$pagina[$k]['total']['comments'] = $r_total[0]->comments;
				$pagina[$k]['total']['shares'] = $r_total[0]->shares;

				$pagina[$k]['desktop']['pageviews_percentual'] =  @number_format($r_device_desktop[0]->pageviews / $r_total[0]->pageviews * 100, 0, ',', '.');
				$pagina[$k]['desktop']['browsers_percentual'] = @number_format($r_device_desktop[0]->browsers / $r_total[0]->browsers * 100, 0, ',', '.');
				$pagina[$k]['desktop']['comments_percentual'] = @number_format($r_device_desktop[0]->comments / $r_total[0]->comments * 100, 0, ',', '.');
				$pagina[$k]['desktop']['shares_percentual'] = @number_format($r_device_desktop[0]->shares / $r_total[0]->shares * 100, 0, ',', '.');

				$pagina[$k]['mobile']['pageviews_percentual'] = @number_format($r_device_mobile[0]->pageviews / $r_total[0]->pageviews * 100, 0, ',', '.');
				$pagina[$k]['mobile']['browsers_percentual'] = @number_format($r_device_mobile[0]->browsers / $r_total[0]->browsers * 100, 0, ',', '.');
				$pagina[$k]['mobile']['comments_percentual'] = @number_format($r_device_mobile[0]->comments / $r_total[0]->comments * 100, 0, ',', '.');
				$pagina[$k]['mobile']['shares_percentual'] = @number_format($r_device_mobile[0]->shares / $r_total[0]->shares * 100, 0, ',', '.');

				$pagina[$k]['direct']['pageviews_percentual'] = @number_format($r_source_direct[0]->pageviews / $r_total[0]->pageviews * 100, 0, ',', '.');
				$pagina[$k]['direct']['browsers_percentual'] = @number_format($r_source_direct[0]->browsers / $r_total[0]->browsers * 100, 0, ',', '.');
				$pagina[$k]['direct']['comments_percentual'] = @number_format($r_source_direct[0]->comments / $r_total[0]->comments * 100, 0, ',', '.');
				$pagina[$k]['direct']['shares_percentual'] = @number_format($r_source_direct[0]->shares / $r_total[0]->shares * 100, 0, ',', '.');

				$pagina[$k]['search']['pageviews_percentual'] = @number_format($r_source_search[0]->pageviews / $r_total[0]->pageviews * 100, 0, ',', '.');
				$pagina[$k]['search']['browsers_percentual'] = @number_format($r_source_search[0]->browsers / $r_total[0]->browsers * 100, 0, ',', '.');
				$pagina[$k]['search']['comments_percentual'] = @number_format($r_source_search[0]->comments / $r_total[0]->comments * 100, 0, ',', '.');
				$pagina[$k]['search']['shares_percentual'] = @number_format($r_source_search[0]->shares / $r_total[0]->shares * 100, 0, ',', '.');

				$pagina[$k]['social']['pageviews_percentual'] = @number_format($r_source_social[0]->pageviews / $r_total[0]->pageviews * 100, 0, ',', '.');
				$pagina[$k]['social']['browsers_percentual'] = @number_format($r_source_social[0]->browsers / $r_total[0]->browsers * 100, 0, ',', '.');
				$pagina[$k]['social']['comments_percentual'] = @number_format($r_source_social[0]->comments / $r_total[0]->comments * 100, 0, ',', '.');
				$pagina[$k]['social']['shares_percentual'] = @number_format($r_source_social[0]->shares / $r_total[0]->shares * 100, 0, ',', '.');

				$pagina[$k]['referrer']['pageviews_percentual'] = @number_format($r_source_referrer[0]->pageviews / $r_total[0]->pageviews * 100, 0, ',', '.');
				$pagina[$k]['referrer']['browsers_percentual'] = @number_format($r_source_referrer[0]->browsers / $r_total[0]->browsers * 100, 0, ',', '.');
				$pagina[$k]['referrer']['comments_percentual'] = @number_format($r_source_referrer[0]->comments / $r_total[0]->comments * 100, 0, ',', '.');
				$pagina[$k]['referrer']['shares_percentual'] = @number_format($r_source_referrer[0]->shares / $r_total[0]->shares * 100, 0, ',', '.');

				echo('<pre>');
				print_r(explode('.', $v->pagina));
				echo('</pre>');

			}

			/**
			  * TO DO:
			  * Popular a tabela destino com os novos dados
			  * 
			  */

			echo('<pre>');
			print_r(explode('.', $v->pagina));
			echo('</pre>');

		}

	}

	function get_top_news_by_day($dia){

		$this->db->select("DATE_FORMAT(data, '%Y-%m-%d') AS data, pagina, pageviews, browsers, comments, shares", FALSE)
			->from($this->table_destino)
			->where('data', $dia)
			->order_by('pageviews DESC, browsers DESC, comments DESC, shares DESC');
		
		$dados = $this->db->get();

		if( $dados->num_rows == 0 ){

			return FALSE;

		} else {

			return $dados;

		}

	}

	function has_temp_editorias_materias($dia){

			$this->db->select("data", FALSE)
					 ->from($this->table_temp)
					 ->where('data', $dia)
					 ->limit(1);

			$dados = $this->db->get();
			
			if( $dados->num_rows > 0 )
				return TRUE;
			else
				return FALSE;

	}

}