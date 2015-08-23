			<style type="text/css">

				.sparqueline {

					height:40px;
					min-width: 100px;
					padding-top:10px;

				}

			</style>

			<div class="panel panel-default">

				<div class="panel-heading">
					Editorias Gazeta do Povo
				</div>
				
				<div class="panel-body">
					
					<div class="row">

						<div class="col-sm-12">

							<div class="table-responsive">

								<table class="table table-model-2 table-hover table-striped">
									
									<thead>
										
										<tr>
											
											<th>Seção</th>
											<th>Total</th>
											<th>Computador</th>
											<th>Celular + Tablet</th>
											<th>Direto</th>
											<th>Buscadores</th>
											<th>Redes Sociais</th>
											<th>Referência</th>
											
										</tr>

									</thead>

									<tbody>
										
										<?php for ($i=0; $i < 10; $i++) { ?>
										<tr>
										
											<td><span style="font-size:1.5em; color:#000;">Vida e Cidadania</span></td>	
											<td>
												<span>1.211.986&nbsp;&nbsp;</span>
												<span class="badge badge-success" style="font-size:1em;">
													45%
													<span class="fa-arrow-circle-up"> </span>
												</span>

												<script type="text/javascript">
												$(function () {
													$('#total<?=$i?>').highcharts({
														chart: {
												        	backgroundColor: null,
												            type: 'area',
												            margin: [0, 0, 0, 0]
												        },
												        exporting: {
												        	enabled: false
												        },
												        title: {
												        	text: ''
												        },
												        xAxis: {
															title: {
												            	text: null
												            },
												            categories: ["30 jul","31 jul","01 ago","02 ago","03 ago","04 ago","05 ago","06 ago","07 ago","08 ago","09 ago","10 ago","11 ago","12 ago","13 ago","14 ago","15 ago","16 ago","17 ago","18 ago","19 ago","20 ago","21 ago","22 ago","23 ago","24 ago","25 ago","26 ago","27 ago","28 ago","29 ago","30 ago"]
												        },
												            yAxis: {
												                endOnTick: false,
												                tickPositions: [0]
												            },
												            legend: {
												                enabled: false
												            },
												            tooltip: {
																headerFormat: '<b>{point.key}:</b> ',
														        pointFormat: '{point.y}',
														        style: {
																	color: '#FFF',
																	fontWeight: 300
																}
												            },
												            plotOptions: {
												                series: {
												                	lineWidth: 2,
												                    shadow: false,
												                    fillOpacity: 0.25,
												                    marker: {
												                        enabled: false
												                    }
												                }
												            },
														series: [{
															name: 'Tempo médio da visita',
															data: [1607,1429,1423,1607,1544,1632,1644,1706,1507,1417,1607,1629,1447,1558,1638,1458,1426,1559,1658,1646,1615,1616,1402,1328,1450,1615,1649,1652,1657,1332]
														}]
													});
												});

												</script>
												<div id="total<?=$i?>" class="sparqueline"></div>

											</td>
											<td>
												<span>1.211.986&nbsp;&nbsp;</span>
												<span class="badge badge-success" style="font-size:1em;">
													45%
													<span class="fa-arrow-circle-up"> </span>
												</span>

												<script type="text/javascript">
												$(function () {
													$('#computador<?=$i?>').highcharts({
														chart: {
												        	backgroundColor: null,
												            type: 'area',
												            margin: [0, 0, 0, 0]
												        },
												        exporting: {
												        	enabled: false
												        },
												        title: {
												        	text: ''
												        },
												        xAxis: {
															title: {
												            	text: null
												            },
												            categories: ["30 jul","31 jul","01 ago","02 ago","03 ago","04 ago","05 ago","06 ago","07 ago","08 ago","09 ago","10 ago","11 ago","12 ago","13 ago","14 ago","15 ago","16 ago","17 ago","18 ago","19 ago","20 ago","21 ago","22 ago","23 ago","24 ago","25 ago","26 ago","27 ago","28 ago","29 ago","30 ago"]
												        },
												            yAxis: {
												                endOnTick: false,
												                tickPositions: [0]
												            },
												            legend: {
												                enabled: false
												            },
												            tooltip: {
																headerFormat: '<b>{point.key}:</b> ',
														        pointFormat: '{point.y}',
														        style: {
																	color: '#FFF',
																	fontWeight: 300
																}
												            },
												            plotOptions: {
												                series: {
												                	lineWidth: 2,
												                    shadow: false,
												                    fillOpacity: 0.25,
												                    marker: {
												                        enabled: false
												                    }
												                }
												            },
														series: [{
															name: 'Tempo médio da visita',
															data: [1607,1429,1423,1607,1544,1632,1644,1706,1507,1417,1607,1629,1447,1558,1638,1458,1426,1559,1658,1646,1615,1616,1402,1328,1450,1615,1649,1652,1657,1332]
														}]
													});
												});

												</script>
												<div id="computador<?=$i?>" class="sparqueline"></div>

											</td>
											<td>
												<span>1.211.986&nbsp;&nbsp;</span>
												<span class="badge badge-success" style="font-size:1em;">
													45%
													<span class="fa-arrow-circle-up"> </span>
												</span>

												<script type="text/javascript">
												$(function () {
													$('#celular-tablet<?=$i?>').highcharts({
														chart: {
												        	backgroundColor: null,
												            type: 'area',
												            margin: [0, 0, 0, 0]
												        },
												        exporting: {
												        	enabled: false
												        },
												        title: {
												        	text: ''
												        },
												        xAxis: {
															title: {
												            	text: null
												            },
												            categories: ["30 jul","31 jul","01 ago","02 ago","03 ago","04 ago","05 ago","06 ago","07 ago","08 ago","09 ago","10 ago","11 ago","12 ago","13 ago","14 ago","15 ago","16 ago","17 ago","18 ago","19 ago","20 ago","21 ago","22 ago","23 ago","24 ago","25 ago","26 ago","27 ago","28 ago","29 ago","30 ago"]
												        },
												            yAxis: {
												                endOnTick: false,
												                tickPositions: [0]
												            },
												            legend: {
												                enabled: false
												            },
												            tooltip: {
																headerFormat: '<b>{point.key}:</b> ',
														        pointFormat: '{point.y}',
														        style: {
																	color: '#FFF',
																	fontWeight: 300
																}
												            },
												            plotOptions: {
												                series: {
												                	lineWidth: 2,
												                    shadow: false,
												                    fillOpacity: 0.25,
												                    marker: {
												                        enabled: false
												                    }
												                }
												            },
														series: [{
															name: 'Tempo médio da visita',
															data: [1607,1429,1423,1607,1544,1632,1644,1706,1507,1417,1607,1629,1447,1558,1638,1458,1426,1559,1658,1646,1615,1616,1402,1328,1450,1615,1649,1652,1657,1332]
														}]
													});
												});

												</script>
												<div id="celular-tablet<?=$i?>" class="sparqueline"></div>

											</td>
											<td>
												<span>1.211.986&nbsp;&nbsp;</span>
												<span class="badge badge-success" style="font-size:1em;">
													45%
													<span class="fa-arrow-circle-up"> </span>
												</span>

												<script type="text/javascript">
												$(function () {
													$('#direto<?=$i?>').highcharts({
														chart: {
												        	backgroundColor: null,
												            type: 'area',
												            margin: [0, 0, 0, 0]
												        },
												        exporting: {
												        	enabled: false
												        },
												        title: {
												        	text: ''
												        },
												        xAxis: {
															title: {
												            	text: null
												            },
												            categories: ["30 jul","31 jul","01 ago","02 ago","03 ago","04 ago","05 ago","06 ago","07 ago","08 ago","09 ago","10 ago","11 ago","12 ago","13 ago","14 ago","15 ago","16 ago","17 ago","18 ago","19 ago","20 ago","21 ago","22 ago","23 ago","24 ago","25 ago","26 ago","27 ago","28 ago","29 ago","30 ago"]
												        },
												            yAxis: {
												                endOnTick: false,
												                tickPositions: [0]
												            },
												            legend: {
												                enabled: false
												            },
												            tooltip: {
																headerFormat: '<b>{point.key}:</b> ',
														        pointFormat: '{point.y}',
														        style: {
																	color: '#FFF',
																	fontWeight: 300
																}
												            },
												            plotOptions: {
												                series: {
												                	lineWidth: 2,
												                    shadow: false,
												                    fillOpacity: 0.25,
												                    marker: {
												                        enabled: false
												                    }
												                }
												            },
														series: [{
															name: 'Tempo médio da visita',
															data: [1607,1429,1423,1607,1544,1632,1644,1706,1507,1417,1607,1629,1447,1558,1638,1458,1426,1559,1658,1646,1615,1616,1402,1328,1450,1615,1649,1652,1657,1332]
														}]
													});
												});

												</script>
												<div id="direto<?=$i?>" class="sparqueline"></div>

											</td>
											<td>
												<span>1.211.986&nbsp;&nbsp;</span>
												<span class="badge badge-success" style="font-size:1em;">
													45%
													<span class="fa-arrow-circle-up"> </span>
												</span>

												<script type="text/javascript">
												$(function () {
													$('#buscadores<?=$i?>').highcharts({
														chart: {
												        	backgroundColor: null,
												            type: 'area',
												            margin: [0, 0, 0, 0]
												        },
												        exporting: {
												        	enabled: false
												        },
												        title: {
												        	text: ''
												        },
												        xAxis: {
															title: {
												            	text: null
												            },
												            categories: ["30 jul","31 jul","01 ago","02 ago","03 ago","04 ago","05 ago","06 ago","07 ago","08 ago","09 ago","10 ago","11 ago","12 ago","13 ago","14 ago","15 ago","16 ago","17 ago","18 ago","19 ago","20 ago","21 ago","22 ago","23 ago","24 ago","25 ago","26 ago","27 ago","28 ago","29 ago","30 ago"]
												        },
												            yAxis: {
												                endOnTick: false,
												                tickPositions: [0]
												            },
												            legend: {
												                enabled: false
												            },
												            tooltip: {
																headerFormat: '<b>{point.key}:</b> ',
														        pointFormat: '{point.y}',
														        style: {
																	color: '#FFF',
																	fontWeight: 300
																}
												            },
												            plotOptions: {
												                series: {
												                	lineWidth: 2,
												                    shadow: false,
												                    fillOpacity: 0.25,
												                    marker: {
												                        enabled: false
												                    }
												                }
												            },
														series: [{
															name: 'Tempo médio da visita',
															data: [1607,1429,1423,1607,1544,1632,1644,1706,1507,1417,1607,1629,1447,1558,1638,1458,1426,1559,1658,1646,1615,1616,1402,1328,1450,1615,1649,1652,1657,1332]
														}]
													});
												});

												</script>
												<div id="buscadores<?=$i?>" class="sparqueline"></div>

											</td>
											<td>
												<span>1.211.986&nbsp;&nbsp;</span>
												<span class="badge badge-success" style="font-size:1em;">
													45%
													<span class="fa-arrow-circle-up"> </span>
												</span>

												<script type="text/javascript">
												$(function () {
													$('#social<?=$i?>').highcharts({
														chart: {
												        	backgroundColor: null,
												            type: 'area',
												            margin: [0, 0, 0, 0]
												        },
												        exporting: {
												        	enabled: false
												        },
												        title: {
												        	text: ''
												        },
												        xAxis: {
															title: {
												            	text: null
												            },
												            categories: ["30 jul","31 jul","01 ago","02 ago","03 ago","04 ago","05 ago","06 ago","07 ago","08 ago","09 ago","10 ago","11 ago","12 ago","13 ago","14 ago","15 ago","16 ago","17 ago","18 ago","19 ago","20 ago","21 ago","22 ago","23 ago","24 ago","25 ago","26 ago","27 ago","28 ago","29 ago","30 ago"]
												        },
												            yAxis: {
												                endOnTick: false,
												                tickPositions: [0]
												            },
												            legend: {
												                enabled: false
												            },
												            tooltip: {
																headerFormat: '<b>{point.key}:</b> ',
														        pointFormat: '{point.y}',
														        style: {
																	color: '#FFF',
																	fontWeight: 300
																}
												            },
												            plotOptions: {
												                series: {
												                	lineWidth: 2,
												                    shadow: false,
												                    fillOpacity: 0.25,
												                    marker: {
												                        enabled: false
												                    }
												                }
												            },
														series: [{
															name: 'Tempo médio da visita',
															data: [1607,1429,1423,1607,1544,1632,1644,1706,1507,1417,1607,1629,1447,1558,1638,1458,1426,1559,1658,1646,1615,1616,1402,1328,1450,1615,1649,1652,1657,1332]
														}]
													});
												});

												</script>
												<div id="social<?=$i?>" class="sparqueline"></div>

											</td>
											<td>
												<span>1.211.986&nbsp;&nbsp;</span>
												<span class="badge badge-success" style="font-size:1em;">
													45%
													<span class="fa-arrow-circle-up"> </span>
												</span>

												<script type="text/javascript">
												$(function () {
													$('#referencia<?=$i?>').highcharts({
														chart: {
												        	backgroundColor: null,
												            type: 'area',
												            margin: [0, 0, 0, 0]
												        },
												        exporting: {
												        	enabled: false
												        },
												        title: {
												        	text: ''
												        },
												        xAxis: {
															title: {
												            	text: null
												            },
												            categories: ["30 jul","31 jul","01 ago","02 ago","03 ago","04 ago","05 ago","06 ago","07 ago","08 ago","09 ago","10 ago","11 ago","12 ago","13 ago","14 ago","15 ago","16 ago","17 ago","18 ago","19 ago","20 ago","21 ago","22 ago","23 ago","24 ago","25 ago","26 ago","27 ago","28 ago","29 ago","30 ago"]
												        },
												            yAxis: {
												                endOnTick: false,
												                tickPositions: [0]
												            },
												            legend: {
												                enabled: false
												            },
												            tooltip: {
																headerFormat: '<b>{point.key}:</b> ',
														        pointFormat: '{point.y}',
														        style: {
																	color: '#FFF',
																	fontWeight: 300
																}
												            },
												            plotOptions: {
												                series: {
												                	lineWidth: 2,
												                    shadow: false,
												                    fillOpacity: 0.25,
												                    marker: {
												                        enabled: false
												                    }
												                }
												            },
														series: [{
															name: 'Tempo médio da visita',
															data: [1607,1429,1423,1607,1544,1632,1644,1706,1507,1417,1607,1629,1447,1558,1638,1458,1426,1559,1658,1646,1615,1616,1402,1328,1450,1615,1649,1652,1657,1332]
														}]
													});
												});

												</script>
												<div id="referencia<?=$i?>" class="sparqueline"></div>

											</td>

										</tr>
										<?php } ?>

									</tbody>

								</table>

							</div>

						</div>

					</div>
					
				</div>

			</div>

		<script src="http://ui.s109969.gridserver.com/highcharts/js/highcharts.js"></script>
		<script src="http://ui.s109969.gridserver.com/highcharts/js/highcharts-global-options.js"></script>
		<script src="http://ui.s109969.gridserver.com/highcharts/js/modules/funnel.js"></script>
		<script src="http://ui.s109969.gridserver.com/highcharts/js/themes/custom.js"></script>
		<script src="http://ui.s109969.gridserver.com/highcharts/js/modules/exporting.js"></script>