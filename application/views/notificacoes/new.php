			<div class="page-title">

				<div class="title-env">
					
					<h1 class="title">Nova notificação</h1>
					
				</div>

				<div class="breadcrumb-env">

					<ol class="breadcrumb bc-1" >
						<li>
							<a href="<?=$this->config->item('base_url')?>"><i class="fa-home"></i>Home</a>
						</li>
						<li class="active">
							<strong>Nova notificação</strong>
						</li>
					</ol>

				</div>

			</div>

			<div class="row">

				<div class="col-md-12">
			
					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							<h3 class="panel-title">Informações da notificação</h3>
						</div>
						
						<div class="panel-body">
							
							<?php if( validation_errors() || isset($message) ) : ?>
							<div class="alert alert-danger">
								<?php echo validation_errors(); ?>
							</div>
							<?php endif; ?>

							<?php
								
								$attributes = array('role' => 'form', 'class' => 'form-horizontal validate');
								echo form_open('notificacoes/add/', $attributes);
							
							?>
								
								<div class="form-group">
									<label class="col-sm-2 control-label" for="titulo">Título da notificação</label>
			
									<div class="col-sm-10">
										<input type="text" class="form-control" placeholder="Exemplo: Nova funcionalidade" id="titulo" name="titulo" data-validate="required" value="<?php echo set_value('titulo'); ?>" />
									</div>
								</div>

								<div class="form-group-separator"></div>
				
								<div class="form-group">
									<label class="col-sm-2 control-label" for="conteudo">Conteúdo da notificação</label>
			
									<div class="col-sm-10">
										<script src="<?=$this->config->item('base_url')?>application/assets/js/ckeditor/ckeditor.js"></script>
										<script src="<?=$this->config->item('base_url')?>application/assets/js/ckeditor/adapters/jquery.js"></script>
										<textarea class="form-control ckeditor" id="conteudo" name="conteudo">
											<?php echo set_value('titulo'); ?>
										</textarea>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-2 control-label"></div>
			
									<div class="col-sm-10">
										<button class="btn btn-info btn-icon btn-icon-standalone btn-lg">
											<i class="fa-plus"></i>
											<span>Adicionar notificação</span>
										</button>	
									</div>
								</div>

							</form>
			
						</div>
					</div>
			
				</div>
			</div>

