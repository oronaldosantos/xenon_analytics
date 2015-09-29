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
							
							<?php if( validation_errors() || isset($message) ) : ?>
							<div class="alert alert-danger">
								<?php echo validation_errors(); ?>
							</div>
							<?php endif; ?>

							<?php
								
								$attributes = array('role' => 'form', 'class' => 'form-horizontal validate');
								echo form_open('usuarios/novo_form_action/', $attributes);
							
							?>
								
								<div class="form-group">
									
									<label class="col-sm-1 control-label" for="nome">Nome completo</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa-user"></i>
											</span>
											<input type="text" class="form-control" placeholder="Exemplo: Ayrton Senna" id="nome" name="nome" data-validate="required" value="<?php echo set_value('nome'); ?>" />
										</div>
									</div>

									<label class="col-sm-1 control-label" for="email">E-mail</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa-at"></i>
											</span>
											<input type="email" class="form-control" placeholder="exemplo@gmail.com" id="email" name="email" data-validate="required,email" value="<?php echo set_value('email'); ?>" />
										</div>
									</div>

								</div>
			
								<div class="form-group-separator"></div>
			
								<div class="form-group">
									
									<label class="col-sm-1 control-label" for="telefone">Telefone</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa-phone"></i>
											</span>
											<input type="text" class="form-control" placeholder="41 9999-9999" id="telefone" name="telefone" data-mask="(99) 9999-9999" data-validate="required" value="<?php echo set_value('telefone'); ?>" />
										</div>
									</div>

									<label class="col-sm-1 control-label" for="username">Nome de Usuário</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon"></span>
											<input type="text" class="form-control" id="username" name="username" data-validate="required" value="<?php echo set_value('username'); ?>" />
										</div>
									</div>

								</div>

								<div class="form-group-separator"></div>
			
								<div class="form-group">
									<div class="col-sm-1"></div>
									<div class="col-sm-3">
										<button class="btn btn-info btn-icon btn-icon-standalone btn-lg">
											<i class="fa-plus"></i>
											<span>Adicionar usuário</span>
										</button>
									</div>
								</div>

							</form>
			
						</div>
					</div>
			
				</div>
			</div>

