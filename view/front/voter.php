
<div class="row">
	
	<?php if (empty($participations)): ?>
		<div class="center">
			<h2> Aucune Photo pour le moment </h2>
			<h3><a href="/participationPhoto/index">Devenez le premier participant au concours </a></h3>
		</div>

	<?php else: ?> <!--On a des participations -->
		<h1 align="center"> Bienvenue sur la page vote </h1>

		<a href="/participationPhoto/index" class="btn btn-default"> Participer</a>

		<hr>

		<h2><?php echo $leConcours->getName() ?></h2>
		<?php foreach ($participations as $key => $value): ?>
			<?php 
				$response = $fb->get($value['id_photo'].'?fields=id,link,picture', $_SESSION['facebook_access_token']);
				$body= $response->getBody();
				$tab = json_decode($body);
	         ?>
	        <div class="img">
				<a target="_blank" href="<?php echo $tab->{'link'} ?>">
					<img src="<?php echo $tab->{'picture'} ?>" >
				</a>
	  			<div class="desc">Username: </div>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>
