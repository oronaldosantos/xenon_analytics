<div class="page-title">

				<div class="title-env">
					
					<h1 class="title">Contato</h1>
					<p class="description">Teste de envio de formulário</p>
				
				</div>

				<div class="breadcrumb-env">

					<ol class="breadcrumb bc-1" >
						<li>
							<a href="<?=$this->config->item('base_url')?>"><i class="fa-home"></i>Home</a>
						</li>
						<li class="active">
							<strong>Contato</strong>
						</li>
					</ol>

				</div>

			</div>

			<div class="row">

				<div class="col-md-12">
			
					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							<h3 class="panel-title">Preencha o formulário abaixo com seus dados</h3>
						</div>
						
						<div class="panel-body">
			
							<form role="form" class="form-horizontal validate" action="<?=$this->config->item('base_url')?>contato/enviar" method="post">
								
								<?php

									if($this->session->flashdata('dados')){

										$cookie_nome 		= $this->session->flashdata('dados')['nome'];
										$cookie_email 		= $this->session->flashdata('dados')['email'];
										$cookie_telefone 	= $this->session->flashdata('dados')['telefone'];
										$cookie_mensagem 	= $this->session->flashdata('dados')['mensagem'];

									} else{

										$cookie_nome 		= "";
										$cookie_email 		= "";
										$cookie_telefone 	= "";
										$cookie_mensagem 	= "";


									}

									$erro 	= $this->session->flashdata('erro');
									$ok 	= $this->session->flashdata('ok');

									if( $erro != "" ) {

								?>

								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Fechar</span>
									</button>
									<h3><span class="fa-frown-o"></span> Oooops!</h3><br />
									<?=$erro?>
								</div>

								<?php

									}

									if( $ok != "" ) {

								?>

								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Fechar</span>
									</button>
									<strong><?=$ok?></strong>
								</div>
								
								<?php } ?>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="nome">Nome completo</label>
			
									<div class="col-sm-10">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa-user"></i>
											</span>
											<input type="text" class="form-control" placeholder="Exemplo: Ayrton Senna" id="nome" name="nome" value="<?=$cookie_nome?>" data-validate="required">
										</div>
									</div>
								</div>
			
								<div class="form-group-separator"></div>
			
								<div class="form-group">
									<label class="col-sm-2 control-label" for="email">E-mail</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa-at"></i>
											</span>
											<input type="email" class="form-control" placeholder="exemplo@gmail.com" id="email" name="email" value="<?=$cookie_email?>" data-validate="required,email">
										</div>
									</div>

									<label class="col-sm-1 control-label" for="telefone">Telefone</label>
									<div class="col-sm-5">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa-phone"></i>
											</span>
											<input type="text" class="form-control" placeholder="41 9999-9999" id="telefone" name="telefone" value="<?=$cookie_telefone?>" data-mask="(99) 9999-9999" data-validate="required">
										</div>
									</div>

								</div>

								<div class="form-group-separator"></div>
			
								<div class="form-group">
									<label class="col-sm-2 control-label" for="mensagem">Mensagem</label>
									<div class="col-sm-10">
										<textarea class="form-control autogrow" cols="5" placeholder="Escreva aqui a sua mensagem..." id="mensagem" name="mensagem" data-validate="required"><?=$cookie_mensagem?></textarea>
									</div>

								</div>

								<div class="form-group-separator"></div>
			
								<div class="form-group">
									<div class="col-sm-2"></div>
									<div class="col-sm-3">
										<button class="btn btn-info btn-icon btn-icon-standalone btn-lg">
											<i class="fa-send"></i>
											<span>Enviar mensagem</span>
										</button>
									</div>
								</div>

							</form>
			
						</div>
					</div>
			
				</div>
			</div>

