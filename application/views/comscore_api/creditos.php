			<div class="page-title">

				<div class="title-env">
					
					<h1 class="title"><?=$title?></h1>
					<p class="description">Créditos disponíveis e utilizados.</p>
				
				</div>

			</div>

			<div class="row">

				<div class="col-md-3">
					
					<div class="xe-widget xe-progress-counter xe-counter-block" data-count=".num" data-from="0" data-to="<?=$creditos->{'remaining-credits'}?>" data-duration="2">
						
						<div class="xe-upper">
							
							<div class="xe-icon">
								<i class="fa-credit-card"></i>
							</div>
							
							<div class="xe-label">
								
								<strong class="num pull-left">0</strong> &nbsp;&nbsp;<?=($creditos->{'remaining-credits'}/$creditos->{'daily-limit'}*100)?>%
								<div class="clearfix"></div>
								<span>Créditos disponíveis</span>

							</div>
							
						</div>
						
						<div class="xe-progress">
							
							<span class="xe-progress-fill" data-fill-from="0" data-fill-to="<?=($creditos->{'remaining-credits'}/$creditos->{'daily-limit'}*100)?>" data-fill-property="width" data-fill-duration="2" data-fill-easing="true"></span>

						</div>

						<div class="xe-lower pull-left">
							
							<span>Utilizados</span>
							<strong><?=($creditos->{'daily-limit'}-$creditos->{'remaining-credits'})?></strong>

						</div>

						<div class="xe-lower pull-left">
							
							<span>Zera em</span>
							<strong><?=date('d M H\h i\m', $creditos->{'reset-time-in-seconds'})?></strong>

						</div>

					</div>

					<?php
						
						#echo("<pre>");
						#print_r($visit_filters);
						#echo("</pre>");
					
					?>

				</div>

			</div>