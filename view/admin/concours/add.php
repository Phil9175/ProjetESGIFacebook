<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form class="form-horizontal" action="<?php echo ADRESSE_SITE; ?>/admin/add" method="POST" enctype="multipart/form-data">
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
					<label class="control-label col-sm-2 requiredField" for="date_debut"> Date de d&eacute;but <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<input class="form-control" id="date_debut" name="date_debut" placeholder="MM/DD/YYYY" type="text" value=""/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="date_fin"> Date de fin <span class="asteriskField"> * </span></label>
					<div class="col-sm-10">
						<input class="form-control" id="date_fin" name="date_fin" placeholder="MM/DD/YYYY" type="text" value=""/>
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
							<input name="statut" type="radio" value="1" />
							Actif </label>
						<label class="radio-inline">
							<input name="statut" type="radio" value="0" checked/>
							Non Actif </label>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button class="btn btn-primary " name="submit" type="submit"> Enregistrer </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

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
			
			$('#date_debut').datetimepicker({value:'<?php echo $date_debut; ?> <?php echo $heure_debut; ?>',step:10});
$.datetimepicker.setLocale('fr');
			$('#date_fin').datetimepicker({
				dayOfWeekStart : 1,
				lang:'fr',
				startDate:	'<?php echo date("d/m/Y"); ?>'
			});
			
			$('#date_fin').datetimepicker({value:'<?php echo $date_fin; ?> <?php echo $heure_fin; ?>',step:10});		
        });

    </script>