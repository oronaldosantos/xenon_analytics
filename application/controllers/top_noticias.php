<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Top_noticias extends MY_Controller {
	
	public function __construct() {
		
		parent::__construct();

		$this->load->library('curl');
		$this->load->library('dax_api');
		$this->load->model('Model_alertas');

	}

	function pop($dia){

		$this->Model_alertas->popula_disp_origem_from_temp($dia);

	}

	public function top_news_by_day($date = null) {

		if (!$date) {
			$date = date("Y-m-d", strtotime("-1 day"));
		}

		$dia_anterior = date('Y-m-d', strtotime($date . "-1 days"));
		$data_view['dia_anterior'] = $dia_anterior;
		
		$dia_posterior = date('Y-m-d', strtotime($date . "+1 days"));
		$data_view['dia_posterior'] = $dia_posterior;

		$date = new DateTime($date);
		$date_formated = $date->format('Ymd');
		$data_view['dia'] = $date->format('d/m/Y');

		$data_header['title'] = "Top páginas";

		$data_view['resultado'] = $this->Model_alertas->get_top_news_by_day($date_formated);
		
		$this->load->view("layout/header", $data_header);
		$this->load->view("layout/top_bar");
		$this->load->view("layout/nav");
		$this->load->view("top_noticias/lista", $data_view);
		$this->load->view("layout/foot");
		$this->load->view("layout/footer");

	}

	public function get_data($dia){

		$date_check = new DateTime();

		if( date('Y-m-d', strtotime($dia)) >= $date_check->format('Y-m-d') ){

			show_error('Dia inválido');

		} else {

			if( $this->Model_alertas->has_temp_editorias_materias($dia) ) {

				show_error('Tabela temporária já tem dados para esta data');

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
							
							show_error('Exception: ' . $e->getMessage());

						}

						echo $date->format('d-m-Y');
						echo '- Sucesso<br /><br />';
						echo('<a href="http://localhost/alertas/get_data/' . $dia_anterior . '"><< ' . $dia_anterior . '</a> - - ');
						echo('<a href="http://localhost/alertas/get_data/' . $dia_posterior . '">' . $dia_posterior . ' >></a>');

					} else {
						
						show_error('Erro no banco de dados.');

					}

				} catch (Exception $e) {
					
					show_error('Exception: ' . $e->getMessage());

					return FALSE;

				}

			}

		}

	}

	function html_dom(){

		$this->load->library('simple_html_dom');

		// Create DOM from URL or file
		$html = file_get_html('http://www.gazetadopovo.com.br/mundo/chuva-de-estrelas-cadentes-podera-ser-vista-do-hemisferio-sul-nesta-terca-feira-d09urnbvduc6703jx50xco00t');

		// Find all images 
		$article['image'] = $html->find('[itemprop=image]', 0)->src;
		$article['data'] = $html->find('[itemprop=datePublished]', 0)->plaintext;
		$article['headline'] = $html->find('[itemprop=headline]', 0)->plaintext;
		$article['author'] = $html->find('[itemprop=author]', 0)->plaintext;
		$article['text'] = $html->find('[itemprop=text]', 0)->plaintext;

		echo('<pre>');
		print_r($article);
		echo('</pre>');

		$stop_words = ' a , agora , ainda , alguém , algum , alguma , algumas , alguns , ampla , amplas , amplo , amplos , ante , antes , ao , aos , após , aquela , aquelas , aquele , aqueles , aquilo , as , até , através , cada , coisa , coisas , com , como , contra , contudo , da , daquele , daqueles , das , de , dela , delas , dele , deles , depois , dessa , dessas , desse , desses , desta , destas , deste , deste , destes , deve , devem , devendo , dever , deverá , deverão , deveria , deveriam , devia , deviam , disse , disso , disto , dito , diz , dizem , do , dos , e , é , ela , elas , ele , eles , em , enquanto , entre , era , essa , essas , esse , esses , esta , está , estamos , estão , estas , estava , estavam , estávamos , este , estes , estou , eu , fazendo , fazer , feita , feitas , feito , feitos , foi , for , foram , fosse , fossem , grande , grandes , há , isso , isto , já , la , lá , lhe , lhes , lo , mas , me , mesma , mesmas , mesmo , mesmos , meu , meus , minha , minhas , muita , muitas , muito , muitos , na , não , nas , nem , nenhum , nessa , nessas , nesta , nestas , ninguém , no , nos , nós , nossa , nossas , nosso , nossos , num , numa , nunca , o , os , ou , outra , outras , outro , outros , para , pela , pelas , pelo , pelos , pequena , pequenas , pequeno , pequenos , per , perante , pode , pude , podendo , poder , poderia , poderiam , podia , podiam , pois , por , porém , porque , posso , pouca , poucas , pouco , poucos , primeiro , primeiros , própria , próprias , próprio , próprios , quais , qual , quando , quanto , quantos , que , quem , são , se , seja , sejam , sem , sempre , sendo , será , serão , seu , seus , si , sido , só , sob , sobre , sua , suas , talvez , também , tampouco , te , tem , tendo , tenha , ter , teu , teus , ti , tido , tinha , tinham , toda , todas , todavia , todo , todos , tu , tua , tuas , tudo , última , últimas , último , últimos , um , uma , umas , uns , vendo , ver , vez , vindo , vir , vos , vós , A , AGORA , AINDA , ALGUÉM , ALGUM , ALGUMA , ALGUMAS , ALGUNS , AMPLA , AMPLAS , AMPLO , AMPLOS , ANTE , ANTES , AO , AOS , APÓS , AQUELA , AQUELAS , AQUELE , AQUELES , AQUILO , AS , ATÉ , ATRAVÉS , CADA , COISA , COISAS , COM , COMO , CONTRA , CONTUDO , DA , DAQUELE , DAQUELES , DAS , DE , DELA , DELAS , DELE , DELES , DEPOIS , DESSA , DESSAS , DESSE , DESSES , DESTA , DESTAS , DESTE , DESTE , DESTES , DEVE , DEVEM , DEVENDO , DEVER , DEVERÁ , DEVERÃO , DEVERIA , DEVERIAM , DEVIA , DEVIAM , DISSE , DISSO , DISTO , DITO , DIZ , DIZEM , DO , DOS , E , É , ELA , ELAS , ELE , ELES , EM , ENQUANTO , ENTRE , ERA , ESSA , ESSAS , ESSE , ESSES , ESTA , ESTÁ , ESTAMOS , ESTÃO , ESTAS , ESTAVA , ESTAVAM , ESTÁVAMOS , ESTE , ESTES , ESTOU , EU , FAZENDO , FAZER , FEITA , FEITAS , FEITO , FEITOS , FOI , FOR , FORAM , FOSSE , FOSSEM , GRANDE , GRANDES , HÁ , ISSO , ISTO , JÁ , LA , LÁ , LHE , LHES , LO , MAS , ME , MESMA , MESMAS , MESMO , MESMOS , MEU , MEUS , MINHA , MINHAS , MUITA , MUITAS , MUITO , MUITOS , NA , NÃO , NAS , NEM , NENHUM , NESSA , NESSAS , NESTA , NESTAS , NINGUÉM , NO , NOS , NÓS , NOSSA , NOSSAS , NOSSO , NOSSOS , NUM , NUMA , NUNCA , O , OS , OU , OUTRA , OUTRAS , OUTRO , OUTROS , PARA , PELA , PELAS , PELO , PELOS , PEQUENA , PEQUENAS , PEQUENO , PEQUENOS , PER , PERANTE , PODE , PUDE , PODENDO , PODER , PODERIA , PODERIAM , PODIA , PODIAM , POIS , POR , PORÉM , PORQUE , POSSO , POUCA , POUCAS , POUCO , POUCOS , PRIMEIRO , PRIMEIROS , PRÓPRIA , PRÓPRIAS , PRÓPRIO , PRÓPRIOS , QUAIS , QUAL , QUANDO , QUANTO , QUANTOS , QUE , QUEM , SÃO , SE , SEJA , SEJAM , SEM , SEMPRE , SENDO , SERÁ , SERÃO , SEU , SEUS , SI , SIDO , SÓ , SOB , SOBRE , SUA , SUAS , TALVEZ , TAMBÉM , TAMPOUCO , TE , TEM , TENDO , TENHA , TER , TEU , TEUS , TI , TIDO , TINHA , TINHAM , TODA , TODAS , TODAVIA , TODO , TODOS , TU , TUA , TUAS , TUDO , ÚLTIMA , ÚLTIMAS , ÚLTIMO , ÚLTIMOS , UM , UMA , UMAS , UNS , VENDO , VER , VEZ , VINDO , VIR , VOS , VÓS ';
		$stop_words = explode(',', $stop_words);
		
		$string = $article['text'];
		$palavrasSemPreposicao = str_ireplace ( $stop_words, " ", $string );
		
		echo($palavrasSemPreposicao.'<br><br><br>');
		echo($article['text']);
		
	}

}