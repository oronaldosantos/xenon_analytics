			<div class="page-title">

				<div class="title-env">
					
					<h1 class="title">Usuários</h1>
					<p class="description">Painel inicial com informações básicas.</p>
				
				</div>

			</div>

			<!-- Removing search and results count filter -->
			<div class="panel panel-default">
				
				<div class="panel-heading">
					
					<h3 class="panel-title">Listagem de todos os usuários (<?=$resultado->num_rows()?>)</h3>

					<a href="<?=$this->config->item('base_url')?>usuarios/novo/" class="btn pull-right btn-info btn-icon btn-icon-standalone">
						<i class="fa-plus"></i>
						<span>Adicionar Usuário</span>
					</a>

				</div>

				<div class="panel-body">

					<?php if( $this->session->flashdata('message') ) : ?>
					<div class="alert alert-success">
						<?=$this->session->flashdata('message')?>
					</div>
					<?php endif; ?>

					<script type="text/javascript">
						jQuery(document).ready(function($)
						{
							$("#usuarios").dataTable({
								language: {
						            url: "<?=$this->config->item('base_url')?>application/assets/js/datatables/language/dataTables.pt-br.lang"
						        },
								
								aLengthMenu: [
									[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]
								]
							});
						});
					</script>

					<table class="table table-bordered table-striped" id="usuarios">
						
						<thead>
							<tr>
								<th># ID</th>
								<th>Nome</th>
								<th>Email</th>
								<th>Telefone</th>
								<th>Nome de Usuário</th>
								<th>Ações</th>
							</tr>
						</thead>
						
						<tbody class="middle-align">
						
							<?php foreach ($resultado->result() as $row) : ?>
							<tr>
								<td><?=$row->id?></td>
								<td><?=$row->name?></td>
								<td><?=$row->email?></td>
								<td><?=$row->phone?></td>
								<td><?=$row->username?></td>
								<td>
									<a href="<?=$this->config->item('base_url')?>usuarios/editar/<?=$row->id?>" class="btn btn-secondary btn-sm btn-icon icon-left">
										Editar
									</a>
									
									<a href="<?=$this->config->item('base_url')?>usuarios/delete/<?=$row->id?>" class="btn btn-danger btn-sm btn-icon icon-left">
										Deletar
									</a>
									
									<a href="<?=$this->config->item('base_url')?>usuarios/bloquear/<?=$row->id?>" class="btn btn-warning btn-sm btn-icon icon-left">
										Bloquear
									</a>
								</td>
							</tr>
							<?php endforeach; ?>

						</tbody>
					
					</table>
					
				</div>

			</div>