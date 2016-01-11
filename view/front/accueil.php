<div id="wrap">
<?php include 'view/front/flashMessage.php'; ?>
	<h2> Appli Facebook </h2>
	<div id="participer">
		 <a class="btn btn-default" href="/participationPhoto/index">Je souhaite participer au concours </a>
	</div>

	<div id="voter">
		<a class="btn btn-default" href="/voter/defaultPage">Je souhaite voter</a>
	</div>

	<?php if($status == "admin"): ?>
	<div id="gerer_concours">
		<a class="btn btn-danger" href="/admin/listAction">Gestion concours</a>
	</div>
	<?php endif; ?>
</div>
