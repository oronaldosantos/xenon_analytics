	<div class="login-container">
	
		<div class="row">
	
			<div class="col-sm-6">
	
				<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						// Reveal Login form
						setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);
	
	
						// Validation and Ajax action
						$("form#login").validate({
							rules: {
								username: {
									required: true
								},
	
								passwd: {
									required: true
								}
							},
	
							messages: {
								username: {
									required: 'Digite o nome de usuário.'
								},
	
								passwd: {
									required: 'Digite a senha.'
								}
							}
						});
	
						// Set Form focus
						$("form#login .form-group:has(.form-control):first .form-control").focus();
					});
				</script>
				
				<!-- Errors container -->
				<div class="errors-container">
					
					<?php echo validation_errors(); ?>
					
				</div>

				<?php

					$attributes = array('role' => 'form', 'id' => 'login', 'class' => 'login-form fade-in-effect');
					echo form_open('login', $attributes);

				?>
	
					<div class="login-header">
						
						<a href="<?=$this->config->item('base_url')?>" class="logo">
							<img src="<?=$this->config->item('base_url')?>application/assets/images/logo@2x.png" alt="" width="80" />
							<span>Analytics</span>
						</a>

					</div>
	
	
					<div class="form-group">
						<label class="control-label" for="username">Nome de usuário</label>
						<input type="text" class="form-control input-dark" name="username" id="username" autocomplete="off" />
					</div>
	
					<div class="form-group">
						<label class="control-label" for="passwd">Senha</label>
						<input type="password" class="form-control input-dark" name="passwd" id="passwd" autocomplete="off" />
					</div>
	
					<div class="form-group">
						<button type="submit" class="btn btn-dark  btn-block text-left">
							<i class="fa-lock"></i>
							Entrar
						</button>
					</div>
	
					<div class="login-footer">
						<a href="<?=$this->config->item('base_url')?>recuperacao_senha/">Esqueceu sua senha?</a>
					</div>

				<?php echo form_close(); ?>
				
				<?php /*
				<div class="external-login">
					
					<a href="#" class="facebook">
						<i class="fa-facebook"></i>
						Entrar com Facebook
					</a>
	
					<a href="#" class="twitter">
						<i class="fa-twitter"></i>
						Entrar com Twitter
					</a>
	
					<a href="#" class="gplus">
						<i class="fa-google-plus"></i>
						Entrar com Google Plus
					</a>
					
				</div>
				*/ ?>
	
			</div>
	
		</div>
	
	</div>