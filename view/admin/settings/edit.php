<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12"> 
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
									<?php 
									if (isset($_SESSION["errors"])):
										foreach($_SESSION["errors"] as $key => $value):
										?>
										<div class="alert alert-<?php echo $value["type"]; ?>">
											<?php echo $value["message"]; ?>
										</div>
										<?php 
										endforeach;
										unset($_SESSION["errors"]);
									endif;
									?>
									
										<div class="caption caption-md"> <i class="icon-globe theme-font hide"></i> <span class="caption-subject font-blue-madison bold uppercase">Parametres de la societe</span> </div>
										<ul class="nav nav-tabs">
											<li class="active"> <a href="#tab_1_1" data-toggle="tab">Informations et parametres</a> </li>
											<li> <a href="#tab_1_2" data-toggle="tab">Logo</a> </li>
											
										</ul>
									</div>
									<div class="portlet-body">
										<div class="tab-content"> 
											<!-- PERSONAL INFO TAB -->
											<div class="tab-pane active" id="tab_1_1">
												<form role="form" method="POST" action="<?php echo ADRESSE_SITE; ?>admin/settings/informations">
													<div class="form-group">
														<label class="control-label">Nom de la societe</label>
														<input type="text" value="<?php echo $nom_societe; ?>" name="nom_societe" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Slogan de la societe</label>
														<input type="text" value="<?php echo $slogan; ?>" name="slogan" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Serveur mail</label>
														<input type="text" value="<?php echo $mail_host; ?>" name="mail_host" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Port du serveur mail</label>
														<input type="text" value="<?php echo $mail_port; ?>" name="mail_port" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Nom d'utilisateur mail</label>
														<input type="text" value="<?php echo $mail_username; ?>" name="mail_username" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Mot de passe mail</label>
														<input type="text" value="<?php echo $mail_password; ?>" name="mail_password" class="form-control"/>
													</div>
												
													<div class="margiv-top-10">
														<button type="submit" class="btn green-haze">
														Sauvegarder les changements </button>
														<button type="reset" class="btn default">
														Annuler </button>
													</div>
												</form>
											</div>
											<!-- END PERSONAL INFO TAB --> 
											<!-- CHANGE AVATAR TAB -->
											<div class="tab-pane" id="tab_1_2">
												<form action="<?php echo ADRESSE_SITE; ?>admin/settings/picture" role="form" enctype="multipart/form-data" method="POST">
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo ADRESSE_SITE.$logo_societe; ?>" alt=""/> </div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
															<div> <span class="btn default btn-file"> <span class="fileinput-new"> Selectionnez une image </span> <span class="fileinput-exists"> Changer </span>
																<input type="file" name="user_photo">
																</span> <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Enlever </a> </div>
														</div>
													</div>
													<div class="margin-top-10"> <button type="submit" class="btn green-haze">
														Sauvegarder les changements </button>
														<button type="reset" class="btn default">
														Annuler </button> </div>
												</form>
											</div>
											<!-- END CHANGE AVATAR TAB --> 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT --> 
				</div>
			</div>
			<!-- END PAGE CONTENT--> 