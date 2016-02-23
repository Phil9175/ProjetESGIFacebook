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
									
										<div class="caption caption-md"> <i class="icon-globe theme-font hide"></i> <span class="caption-subject font-blue-madison bold uppercase">Ajout de concours</span> </div>
										<ul class="nav nav-tabs">
											<li class="active"> <a href="#tab_1_1" data-toggle="tab">Informations et parametres</a> </li>
											<li> <a href="#tab_1_2" data-toggle="tab">Logo</a> </li>
											
										</ul>
									</div>
									<div class="portlet-body">
										<div class="tab-content"> 
											<!-- PERSONAL INFO TAB -->
											<div class="tab-pane active" id="tab_1_1">
								<form class="form-horizontal" action="<?php echo ADRESSE_SITE; ?>admin/add" method="POST" role="form" enctype="multipart/form-data">
													<input type="hidden" name="validation" value="oui">
				<div class="form-group ">
					<label class="control-label col-sm-2 requiredField" for="nom"> Nom <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<input class="form-control" id="nom" name="nom" type="text" />
					</div>
				</div>
				<div class="form-group ">
					<label class="control-label col-sm-2 requiredField" for="description"> Description <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<textarea class="form-control ckeditor" cols="100" id="description" name="description" rows="10"></textarea>
					</div>
				</div>
				<div class="form-group ">
					<label class="control-label col-sm-2 requiredField" for="max_per_page"> Maximum de photos par pages <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<input class="form-control" id="max_per_page" name="max_per_page" type="text"/>
					</div>
				</div>
				
				<div class="form-group ">
					<label class="control-label col-sm-2 requiredField" for="date_debut"> Date de d&eacute;but <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<input class="form-control" id="date_debut" name="date_debut" placeholder="MM/DD/YYYY" type="text" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="date_fin"> Date de fin <span class="asteriskField"> * </span></label>
					<div class="col-sm-10">
						<input class="form-control" id="date_fin" name="date_fin" placeholder="MM/DD/YYYY" type="text" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="picker_font"> Couleur de la police </label>
					<div class="col-sm-10">
						<input class="form-control" id="picker_font" name="picker_font" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="picker_back"> Couleur du background </label>
					<div class="col-sm-10">
						<input class="form-control" id="picker_back" name="picker_back" />
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="control-label col-sm-2 requiredField" for="statut"> Statut du concours <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input name="status" type="radio" value="1" />
							Actif </label>
						<label class="radio-inline">
							<input name="status" type="radio" value="0" />
							Non Actif </label>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2 requiredField" for="statut"> Methode de notification des utilisateurs <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input name="methode_notification" type="radio" value="email" />
							Email </label>
						<label class="radio-inline">
							<input name="methode_notification" type="radio" value="notification" />
							Notification </label>
					</div>
				</div>
				
												
													
											</div>
											<!-- END PERSONAL INFO TAB --> 
											<!-- CHANGE AVATAR TAB -->
											<div class="tab-pane" id="tab_1_2">
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo ADRESSE_SITE.LOGO; ?>" alt=""/> </div>
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
			
<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/js/colorpicker.js"></script> 

<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/js/jquery.datetimepicker.full.js"></script>

<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>view/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
        $(document).ready(function() {
            $('#picker_font').ColorPicker({
                onSubmit : function(hsb, hex, rgb, el) {
                    $(el).val('#' + hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow : function() {
                    $(this).ColorPickerSetColor(this.value);
                },
				onChange: function (hsb, hex, rgb) {
					$('#picker_font').css('backgroundColor', '#' + hex);
					$('#picker_font').val('#' + hex);
				}
	
            }).bind('keyup', function() {
                $(this).ColorPickerSetColor(this.value);
            });
			
			 $('#picker_back').ColorPicker({
                onSubmit : function(hsb, hex, rgb, el) {
                    $(el).val('#' + hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow : function() {
                    $(this).ColorPickerSetColor(this.value);
                },
				onChange: function (hsb, hex, rgb) {
					$('#picker_back').css('backgroundColor', '#' + hex);
					$('#picker_back').val('#' + hex);
				}
	
            }).bind('keyup', function() {
                $(this).ColorPickerSetColor(this.value);
            });
			
			$.datetimepicker.setLocale('fr');
			$('#date_debut').datetimepicker({
				dayOfWeekStart : 1,
				lang:'fr',
				startDate:	'<?php echo date("d/m/Y"); ?>'
			});
			
			$('#date_debut').datetimepicker({value:'<?php echo date("d/m/Y H:i:s"); ?>',step:10});
$.datetimepicker.setLocale('fr');
			$('#date_fin').datetimepicker({
				dayOfWeekStart : 1,
				lang:'fr',
				startDate:	'<?php echo date("d/m/Y"); ?>'
			});
			
			$('#date_fin').datetimepicker({value:'<?php echo date("d/m/Y H:i:s"); ?>',step:10});
        });

    </script>