<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form class="form-horizontal" action="https://www.concoursphotosesgi.com/admin/edit/<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="validation" value="oui">
				<div class="form-group ">
					<label class="control-label col-sm-2 requiredField" for="nom"> Nom <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<input class="form-control" id="nom" name="nom" type="text" value="<?php echo $nom; ?>"/>
					</div>
				</div>
				<div class="form-group ">
					<label class="control-label col-sm-2 requiredField" for="description"> Description <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<textarea class="form-control" cols="40" id="description" name="description" rows="10"><?php echo $description; ?></textarea>
					</div>
				</div>
				<div class="form-group ">
					<label class="control-label col-sm-2 requiredField" for="date_debut"> Date de d&eacute;but <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<input class="form-control" id="date_debut" name="date_debut" placeholder="MM/DD/YYYY" type="text" value="<?php echo $date_debut; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="date_fin"> Date </label>
					<div class="col-sm-10">
						<input class="form-control" id="date_fin" name="date_fin" placeholder="MM/DD/YYYY" type="text" value="<?php echo $date_fin; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="picker_font"> Couleur de la police </label>
					<div class="col-sm-10">
						<input class="form-control" id="picker_font" name="picker_font" value="<?php echo $font_color; ?>" style="background-color: <?php echo $font_color; ?>;"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="picker_back"> Couleur du background </label>
					<div class="col-sm-10">
						<input class="form-control" id="picker_back" name="picker_back" value="<?php echo $background_color; ?>" style="background-color: <?php echo $background_color; ?>;"/>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="control-label col-sm-2 requiredField" for="statut"> Statut du concours <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input name="statut" type="radio" value="1" <?php if ($status == 1) echo "checked"; ?>/>
							Actif </label>
						<label class="radio-inline">
							<input name="statut" type="radio" value="0" <?php if ($status == 0) echo "checked"; ?>/>
							Non Actif </label>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2 requiredField" for="statut"> Logo du concours <span class="asteriskField"> * </span> </label>
					<div class="col-sm-10">
					<img src="https://www.concoursphotosesgi.com<?php echo $logo; ?>">
							<input name="logo" type="file" />
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
			
			
        });

    </script>