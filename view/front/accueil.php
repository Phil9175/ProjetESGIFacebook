<div id="wrap">
<?php include 'view/front/flashMessage.php'; ?>

	<div id="haut_concours">
		<p class="left"> <img width="297.5px" height="421px" src="/view/images/logo_photoquizz.gif"> </p>
		<h2 id="titre_concours"> Concours Photo </h2>
	</div>

	<div id="participer">
		 <a class="btn btn-info" href="/participationPhoto/index"> <img src="/view/images/participer.png" height="32" width="32"> Je souhaite participer au concours </a>
	</div>

	<div id="voter">
		<a class="btn btn-success" href="/voter/defaultPage"> <img src="/view/images/voter.png" height="32" width="32"> Je souhaite voter</a>
	</div>

	<?php if($status == "admin"): ?>
	<div id="gerer_concours">
		<a class="btn btn-danger" href="/admin">Gestion concours</a>
	</div>
	<?php endif; ?>
</div>
