<body class="page-body login-page">

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
							},
	
							// Form Processing via AJAX
							submitHandler: function(form)
							{
								show_loading_bar(70); // Fill progress bar to 70% (just a given value)
	
								var opts = {
									"closeButton": true,
									"debug": false,
									"positionClass": "toast-top-full-width",
									"onclick": null,
									"showDuration": "300",
									"hideDuration": "1000",
									"timeOut": "5000",
									"extendedTimeOut": "1000",
									"showEasing": "swing",
									"hideEasing": "linear",
									"showMethod": "fadeIn",
									"hideMethod": "fadeOut"
								};
	
								$.ajax({
									url: "<?=$this->config->item('base_url')?>login/check/",
									method: 'POST',
									dataType: 'json',
									data: {
										do_login: true,
										username: $(form).find('#username').val(),
										passwd: $(form).find('#passwd').val(),
									},
									success: function(resp)
									{
										show_loading_bar({
											delay: .5,
											pct: 100,
											finish: function(){
	
												// Redirect after successful login page (when progress bar reaches 100%)
												if(resp.accessGranted) {
													window.location.href = '<?=$this->config->item('base_url')?>dashboard/';
												} else {
													toastr.error("Usuário ou senha inválidos, por favor verifique os dados.", "Dados incorretos!", opts);
													$(form).find('#passwd').select();
												}
											}
										});
									}
								});
							}
						});
	
						// Set Form focus
						$("form#login .form-group:has(.form-control):first .form-control").focus();
					});
				</script>
	
				<!-- Add class "fade-in-effect" for login form effect -->
				<form method="post" role="form" id="login" class="login-form fade-in-effect">
	
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
						<button type="submit" class="btn btn-dark  btn-block text-left">
							<i class="fa-lock"></i>
							Recuperar senha
						</button>
					</div>
	
					<div class="login-footer">
						<a href="<?=$this->config->item('base_url')?>">Voltar para tele de Login</a>
					</div>
	
				</form>
	
			</div>
	
		</div>
	
	</div>