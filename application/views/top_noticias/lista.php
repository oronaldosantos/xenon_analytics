			<div class="page-title">

				<div class="title-env">
					
					<h1 class="title">Top páginas</h1>
					<p class="description">As páginas mais acessadas</p>
				
				</div>

			</div>

			<div class="row">

				<div class="col-md-12">

					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							
							<h3 class="panel-title">Top 10 páginas em <?=$dia?></h3>

							<a href="<?=$this->config->item('base_url')?>/top_noticias/top_news_by_day/<?=$dia_posterior?>" class="btn btn-info btn-icon btn-icon-standalone btn-icon-standalone-right pull-right">
								<i class="fa-arrow-right"></i>
								<span>Próximo dia</span>
							</a>

							<a href="<?=$this->config->item('base_url')?>/top_noticias/top_news_by_day/<?=$dia_anterior?>" class="btn btn-info btn-icon btn-icon-standalone pull-right">
								<i class="fa-arrow-left"></i>
								<span>Dia Anterior</span>
							</a>

						</div>
						
						<div class="panel-body">
							
							<?php if ( $resultado ) : ?>
							<table class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Página</th>
										<th>Pageviews</th>
										<th>Browsers</th>
										<th>Comentários</th>
										<th>Compartilhamentos</th>
									</tr>
								</thead>
								
								<tbody class="middle-align">
						
									<?php foreach ($resultado->result() as $row) : ?>
									<tr>
										<td><?=$row->pagina?></td>
										<td><?=number_format($row->pageviews, 0, ',', '.')?></td>
										<td><?=number_format($row->browsers, 0, ',', '.')?></td>
										<td><?=number_format($row->comments, 0, ',', '.')?></td>
										<td><?=number_format($row->shares, 0, ',', '.')?></td>
									</tr>
									<?php endforeach; ?>

								</tbody>

							</table>

							<i class="pull-right">Fonte: comScore Digital Analytix, <?=$dia?></i>

						<?php else : ?>
							
							<p>Nenhum registro encontrado.</p>

						<?php endif; ?>
							
						</div>

					</div>

				</div>

			</div>