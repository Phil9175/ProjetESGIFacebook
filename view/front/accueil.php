<div id="wrap">
<?php include 'view/front/flashMessage.php'; ?>

	<div id="haut_concours">
		<p class="left"> <img width="200px" src="<?php echo ADRESSE_SITE.LOGO; ?>"> </p><br>
		<h2 id="titre_concours"> Concours Photo </h2>
	</div>

	<?php if ($open == TRUE): ?>
	<div id="participer">
		 <a class="btn btn-info" href="<?php echo ADRESSE_SITE; ?>participationPhoto/index"> <img src="<?php echo ADRESSE_SITE; ?>view/images/participer.png" height="32" width="32"> Je souhaite participer au concours </a>
	</div>

	<div id="voter">
		<a class="btn btn-success" href="<?php echo ADRESSE_SITE; ?>voter/defaultPage"> <img src="<?php echo ADRESSE_SITE; ?>view/images/voter.png" height="32" width="32"> Je souhaite voter</a>
	</div>
	<?php else: ?>
	
	<div class="alert alert-info">
	  <strong>Malheureusement ...</strong> Aucun concours n'est disponible pour le moment, revenez plus tard :)
	</div>
	
	<?php endif; ?>

	<?php if($is_admin == TRUE): ?>
	<div id="gerer_concours">
		<a class="btn btn-danger" href="<?php echo ADRESSE_SITE; ?>admin">Gestion concours</a>
	</div>
	<?php endif; ?>
</div>
