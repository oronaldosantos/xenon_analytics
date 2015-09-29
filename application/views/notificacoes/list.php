			<div class="page-title">

				<div class="title-env">
					
					<h1 class="title">Notificações</h1>
					<p class="description">Gerenciamento de notificações.</p>
				
				</div>

			</div>

			<!-- Removing search and results count filter -->
			<div class="panel panel-default">
				
				<div class="panel-heading">
					
					
					<h3 class="panel-title">
						<?php if( $resultado ) : ?>
							Listagem de todos as notificações (<?=$resultado->num_rows()?>)
						<?php else : ?>
							<?php echo $this->session->flashdata('message_error') ?>
						<?php endif; ?>
					</h3>

					<a href="<?=$this->config->item('base_url')?>notificacoes/novo/" class="btn pull-right btn-info btn-icon btn-icon-standalone">
						<i class="fa-plus"></i>
						<span>Adicionar notificação</span>
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
							$("#notificacoes").dataTable({
								language: {
						            url: "<?=$this->config->item('base_url')?>application/assets/js/datatables/language/dataTables.pt-br.lang"
						        },
								
								aLengthMenu: [
									[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]
								]
							});
						});
					</script>

					<?php if( $resultado ) : ?>

					<table class="table table-bordered table-striped" id="notificacoes">
						
						<thead>
							<tr>
								<th># ID</th>
								<th>Título</th>
								<th>Conteúdo</th>
								<th>Data e Hora</th>
								<th>Ações</th>
							</tr>
						</thead>
						
						<tbody class="middle-align">
						
							<?php foreach ($resultado->result() as $row) : ?>
							<tr>
								<td><?=$row->id?></td>
								<td><?=$row->title?></td>
								<td><?=$row->content?></td>
								<td><?=$row->date_time?></td>
								<td>
									<a href="<?=$this->config->item('base_url')?>notificacoes/editar/<?=$row->id?>" class="btn btn-secondary btn-sm btn-icon icon-left">
										Editar
									</a>
									
									<a href="<?=$this->config->item('base_url')?>notificacoes/delete/<?=$row->id?>" class="btn btn-danger btn-sm btn-icon icon-left">
										Deletar
									</a>
								</td>
							</tr>
							<?php endforeach; ?>

						</tbody>
					
					</table>

					<?php endif; ?>
					
				</div>

			</div>