
<div class="moduleCenter">
		
	
			<!--
			protected $name;
			protected $description;
			protected $startDate;
			protected $endDate;
			protected $ranking;
			protected $award;
			protected $status;
			protected $logo;
			protected $font;
			protected $fontFamily;
	-->
	
	<form action="https://concoursphotosesgi.com/admin/edit/<?php echo $id; ?>" method="POST">
	<input type="hidden" name="validation" value="oui">
	<label>Nom du concours</label>
	<input type="text" name="nom" value="<?php echo $nom; ?>"><br>
	<label>Description</label>
	<input type="text" name="description"><br>
	<label>Date de début</label>
	<input type="text" name="date_debut"><br>
	<label>Date de fin</label>
	<input type="text" name="date_fin"><br>
	
	<input type="submit" value="Envoyer">
	
	</form>		
	</div>
