<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form class="form-horizontal" action="https://concoursphotosesgi.com/admin/edit/<?php echo $id; ?>" method="POST">
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
				<div class="form-group ">
					<label class="control-label col-sm-2" for="date_fin"> Date </label>
					<div class="col-sm-10">
						<input class="form-control" id="date_fin" name="date_fin" placeholder="MM/DD/YYYY" type="text" value="<?php echo $date_fin; ?>"/>
					</div>
				</div>
				<div class="form-group" id="div_statut">
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
					<div class="col-sm-10 col-sm-offset-2">
						<button class="btn btn-primary " name="submit" type="submit"> Enregistrer </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
