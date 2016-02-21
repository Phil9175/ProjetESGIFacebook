<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					
					<!-- Begin: life time stats -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Liste des utilisateurs</span>
								<span class="caption-helper">Voir tous les utilisateurs</span>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-default btn-circle" href="javascript:;" data-toggle="dropdown">
									<i class="fa fa-share"></i>
									<span class="hidden-480">
									Outils </span>
									<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="<?php echo ADRESSE_SITE."admin/export/".$id; ?>">
											Exporter en Excel </a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
								<thead>
								<tr role="row" class="heading">
									<th width="2%">
									</th>
									<th width="5%">
										 Prénom
									</th>
									<th width="5%">
										 Nom
									</th>
									<th width="10%">
										 Genre
									</th>
									<th width="15%">
										 Photo
									</th>
									<th width="15%">
										 Nombre de votes
									</th>
									<th width="20%">
										 Date de participation
									</th>
									<th width="15%">
										 Date de Naissance
									</th>
									<th width="15%">
										 Adresse Mail
									</th>
								</tr>
								
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->