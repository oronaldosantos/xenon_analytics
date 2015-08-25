			<div class="page-title">

				<div class="title-env">
					
					<h1 class="title"><?=$title?></h1>
					<p class="description">Lista de relatórios, segementos, filtros de visista, filtro de eventos, sites e funis.</p>
				
				</div>

			</div>

			<div class="row">

				<?php if( $this->session->flashdata('message') ) : ?>
				<div class="col-md-12">
					
					<div class="alert alert-success">
						<?=$this->session->flashdata('message')?>
					</div>
					
				</div>
				<?php endif; ?>

				<div class="col-md-6">

					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							
							<h3 class="panel-title">
								Report Itens<br />
								<?php $result_reports = $reports_update->result(); ?>
								<small class="text-muted">Última atualização em: <?=date("d-M-Y \à\s H:i:s", strtotime($result_reports[0]->date_time))?></small>
							</h3>
							
							<a href="<?=$this->config->item('base_url')?>comscore_api/refresh_reports/" class="btn pull-right btn-info btn-icon btn-icon-standalone">
								<i class="fa-refresh"></i>
								<span>Atualizar lista</span>
							</a>

						</div>
						
						<div class="panel-body">

							<script type="text/javascript">
								jQuery(document).ready(function($)
								{
									$("#reports,#segments,#visit_filters,#event_filters,#sites,#funnels").dataTable({
										pagingType: "simple",
										language: {
								            url: "<?=$this->config->item('base_url')?>application/assets/js/datatables/language/dataTables.pt-br.lang"
								        },
										
										aLengthMenu: [
											[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]
										]
									});
								});
							</script>
							
							<table id="reports" class="table table-condensed table-striped table-hover">
								
								<thead>
									
									<tr>
										<th>DAX ID</th>
										<th>Report Name</th>
									</tr>
								
								</thead>

								<tbody>
							
								<?php foreach($reports->result() as $row) : $report = explode("|",$row->dax_report_path); ?>
									
									<tr>
										<td style="width:75px"><?=$row->dax_report_id?></td>
										<td><?=end($report)?></td>
									</tr>
									
								<?php endforeach; ?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

				<div class="col-md-6">

					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							
							<h3 class="panel-title">
								Segments<br />
								<?php $results_segments = $segments_update->result(); ?>
								<small class="text-muted">Última atualização em: <?=date("d-M-Y \à\s H:i:s", strtotime($results_segments[0]->date_time))?></small>
							</h3>

							<a href="<?=$this->config->item('base_url')?>comscore_api/refresh_segments" class="btn pull-right btn-info btn-icon btn-icon-standalone">
								<i class="fa-refresh"></i>
								<span>Atualizar lista</span>
							</a>

						</div>
						
						<div class="panel-body">

							<table id="segments" class="table table-condensed table-striped table-hover">
								
								<thead>
									
									<tr>
										<th>DAX ID</th>
										<th>Segment Name</th>
										<th>Folder</th>
									</tr>
								
								</thead>

								<tbody>
							
								<?php foreach($segments->result() as $row) : ?>
									
									<tr>
										<td style="width:75px"><?=$row->dax_segment_id?></td>
										<td><?=$row->dax_segment_name?></td>
										<td><?=$row->dax_segment_folder?></td>
									</tr>
									
								<?php endforeach; ?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

				<div class="col-md-6">

					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">

							<h3 class="panel-title">
								Visit Filters<br />
								<?php $result_visit_filters = $visit_filters_update->result(); ?>
								<small class="text-muted">Última atualização em: <?=date("d-M-Y \à\s H:i:s", strtotime($result_visit_filters[0]->date_time))?></small>
							</h3>

							<a href="<?=$this->config->item('base_url')?>/comscore_api/refresh_visit_filters/" class="btn pull-right btn-info btn-icon btn-icon-standalone">
								<i class="fa-refresh"></i>
								<span>Atualizar lista</span>
							</a>

						</div>
						
						<div class="panel-body">

							<table id="visit_filters" class="table table-condensed table-striped table-hover">
								
								<thead>
									
									<tr>
										<th>DAX ID</th>
										<th>Visit Filter Name</th>
										<th>Folder</th>
									</tr>
								
								</thead>

								<tbody>
							
								<?php foreach($visit_filters->result() as $row) : ?>
									
									<tr>
										<td style="width:75px"><?=$row->dax_visit_filter_id?></td>
										<td><?=$row->dax_visit_filter_name?></td>
										<td><?=$row->dax_visit_filter_folder?></td>
									</tr>
									
								<?php endforeach; ?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

				<div class="col-md-6">

					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							
							<h3 class="panel-title">
								Event Filters<br />
								<?php $event_filters_result = $event_filters_update->result(); ?>
								<small class="text-muted">Última atualização em: <?=date("d-M-Y \à\s H:i:s", strtotime($event_filters_result[0]->date_time))?></small>
							</h3>

							<a href="<?=$this->config->item('base_url')?>comscore_api/refresh_event_filters/" class="btn pull-right btn-info btn-icon btn-icon-standalone">
								<i class="fa-refresh"></i>
								<span>Atualizar lista</span>
							</a>

						</div>
						
						<div class="panel-body">

							<table id="event_filters" class="table table-condensed table-striped table-hover">
								
								<thead>
									
									<tr>
										<th>DAX ID</th>
										<th>Event Filter Name</th>
										<th>Folder</th>
									</tr>
								
								</thead>

								<tbody>
							
								<?php foreach($event_filters->result() as $row) : ?>
									
									<tr>
										<td style="width:75px"><?=$row->dax_event_filter_id?></td>
										<td><?=$row->dax_event_filter_name?></td>
										<td><?=$row->dax_event_filter_folder?></td>
									</tr>
									
								<?php endforeach; ?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

				<div class="col-md-6">

					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							
							<h3 class="panel-title">
								Sites<br />
								<?php $sites_result = $sites_update->result(); ?>
								<small class="text-muted">Última atualização em: <?=date("d-M-Y \à\s H:i:s", strtotime($sites_result[0]->date_time))?></small>
							</h3>

							<a href="<?=$this->config->item('base_url')?>comscore_api/refresh_sites/" class="btn pull-right btn-info btn-icon btn-icon-standalone">
								<i class="fa-refresh"></i>
								<span>Atualizar lista</span>
							</a>

						</div>
						
						<div class="panel-body">

							<table id="sites" class="table table-condensed table-striped table-hover">
								
								<thead>
									
									<tr>
										<th># ID</th>
										<th>Site Name</th>
									</tr>
								
								</thead>

								<tbody>
							
								<?php foreach($sites->result() as $row) : ?>
									
									<tr>
										<td><?=$row->id?></td>
										<td><?=$row->site?></td>
									</tr>
									
								<?php endforeach; ?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

				<div class="col-md-6">

					<div class="panel panel-default panel-shadow">
						
						<div class="panel-heading">
							
							<h3 class="panel-title">
								Funnels<br />
								<?php $funnels_result = $funnels_update->result(); ?>
								<small class="text-muted">Última atualização em: <?=date("d-M-Y \à\s H:i:s", strtotime($funnels_result[0]->date_time))?></small>
							</h3>

							<a href="<?=$this->config->item('base_url')?>comscore_api/refresh_funnels/" class="btn pull-right btn-info btn-icon btn-icon-standalone">
								<i class="fa-refresh"></i>
								<span>Atualizar lista</span>
							</a>

						</div>
						
						<div class="panel-body">

							<table id="funnels" class="table table-condensed table-striped table-hover">
								
								<thead>
									
									<tr>
										<th>DAX ID</th>
										<th>Funnel Name</th>
									</tr>
								
								</thead>

								<tbody>
							
								<?php foreach($funnels->result() as $row) : ?>
									
									<tr>
										<td style="width:75px"><?=$row->dax_funnel_id?></td>
										<td><?=$row->dax_funnel_name?></td>
									</tr>
									
								<?php endforeach; ?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

			</div>