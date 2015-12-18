<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php echo APP_ID; ?>',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/fr_FR/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="row">
	
	<?php if (empty($participations)): ?>
		<div class="center">
			<h2> Aucune Photo pour le moment </h2>
			<h3><a href="/participationPhoto/index">Devenez le premier participant au concours </a></h3>
		</div>

	<?php else: ?> <!--On a des participations -->
		<h1 align="center"> Bienvenue sur la page vote </h1>
		<?php if ($maParticipation->getIdParticipant()): ?>
			<?php 

			$response = $fb->get($maParticipation->getIdPhoto().'?fields=id,link,picture,source', $_SESSION['facebook_access_token']);
			$tab = $response->getDecodedBody(); 

			?>
			<div class="my-photo">
				<a target="_blank" href="<?php echo $tab['link'] ?>">
					<img src="<?php echo $tab['picture'] ?>" >
				</a>
	  			<div class="desc">
		  			Votre Photo: <br>
					<div class="fb-like"
						data-href="<?php echo $maParticipation->getPhotoPath(); ?>"
						data-layout="button_count"
						data-action="like"
						data-show-faces="false">
					</div>
	  			</div>
  			</div>
		<?php else: ?> <!-- le User n'a pas encore choisit de photo --> 
			<a href="/participationPhoto/index" class="btn btn-default"> Participer</a>
		<?php endif ?>
		

		<hr>

		<h2><?php echo $leConcours->getName() ?></h2>
		<?php $ranking = array(); ?>
		<?php foreach ($participations as $key => $value): ?>
			<?php 
				$response = $fb->get($value['id_photo'].'?fields=id,link,picture,source', $_SESSION['facebook_access_token']);
				$tab = $response->getDecodedBody();
			
	         ?>
	        <div class="img">
				<a target="_blank" href="<?php echo $tab['link'] ?>">
					<img src="<?php echo $tab['picture'] ?>" >
				</a>
	  			<div class="desc">
		  			Username: <?php echo $value['name']; ?> <br>
					<div class="fb-like"
						data-href="<?php echo "/view/uploads/concours_photos/".$value['id_photo'].".jpg"; ?>"
						data-layout="button_count"
						data-action="like"
						data-show-faces="false">
					</div>
	  			</div>
			</div>
		<?php endforeach ?>
		<?php die(); ?>
	<?php endif ?>

</div>

<script type="text/javascript">
	
	function checkLoginState() {

	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
	 }


	 function statusChangeCallback(response) {

	    if (response.status === 'connected') {
	      console.log("is connected and authorized");
	      getInfo();
	    } else if (response.status === 'not_authorized') {
	      console.log("is connected but not authorized");
	    } else {
	      console.log("is not connected");
	    }
	  }

	  function getInfo(){
	  	
	  }
</script>
<!-- <fb:login-button scope="public_profile,email,publish_actions"  onlogin="checkLoginState();"></fb:login-button> -->
