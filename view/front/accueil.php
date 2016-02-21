<div id="wrap">
<?php include 'view/front/flashMessage.php'; ?>

	<div id="top_concours">
		<h2 id="title_concours"> Concours Photo </h2>
	    <p class="left_logo"> <img id="logo" src="<?php echo ADRESSE_SITE; ?>view/images/logo_photoquizz.svg"> </p>	
	</div>


	<div id="content_concours">

			<?php if ($open == TRUE): ?> 
			<div class="button_accueil">
				<a class="btn btn-info" href="<?php echo ADRESSE_SITE; ?>participationPhoto/index"> <img class="left" src="<?php echo ADRESSE_SITE; ?>view/images/participer.png" height="32" width="32"> Je souhaite participer au concours</a>
			</div>

			<div class="button_accueil">
				<a class="btn btn-success" href="<?php echo ADRESSE_SITE; ?>voter/defaultPage"> <img class="left" src="<?php echo ADRESSE_SITE; ?>view/images/voter.png" height="32" width="32"> Je souhaite voter</a>
			</div>
			<?php else: ?> 
			
			<div class="alert alert-info">
			  <strong>Malheureusement ...</strong> Aucun concours n'est disponible pour le moment, revenez plus tard :)
			</div>
			
			<?php endif; ?> 

			<?php if($is_admin == TRUE): ?>
			<div class="button_accueil">
				<a class="btn btn-danger" href="<?php echo ADRESSE_SITE; ?>admin">Gestion concours</a>
			</div>
			<?php endif; ?> 

	</div>

	<div id="bottom_concours">

		<p> Application Concours photos 2016 Facebook </p>

	</div>


</div>
