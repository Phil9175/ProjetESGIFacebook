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

<script type="text/javascript" src="<?php echo ADRESSE_SITE; ?>/view/js/internal/photo-gallery.js"></script>

<div class="">
	
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
			<div class="container no-margin">
			<div class="center">
			
				<ul align="center" class=" gallery">
					<li class="" data-id="">
	                	<img class="" style="height: 200px; width: 200px;" src="<?php echo $maParticipation->getPhotoPath(); ?>">
	                	<br>
	                	<h3><strong>Votre Photo:</strong></h3>
				  			<div 
							style="overflow: hidden !important;"
				  			class="fb-like"
							data-href="<?php echo $maParticipation->getPhotoPath(); ?>" 
							data-layout="box_count" 
							data-action="like" 
							data-show-faces="true" 
							data-share="false">
	            	</li>
				</ul>
				</div>
			</div>
	  			
		<?php else: ?> <!-- le User n'a pas encore choisit de photo --> 
			<a href="/participationPhoto/index" class="btn btn-default"> Participer</a>
		<?php endif ?>
		

		<hr class="separe-block">

		<div class="container no-margin">
		<h2 class="oswald" align="center">Concours photo: <u><?php echo $leConcours->getName() ?></u></h2>
		<br>
			<ul class="row gallery">
			<?php foreach ($participations as $key => $value): ?>
				<?php 
					/*$response = $fb->get($value['id_photo'].'?fields=id,link,picture,source', $_SESSION['facebook_access_token']);
					
					$tab = $response->getDecodedBody();*/
				
		         ?>
		        
	        	<li  id="ancreNom-<?php echo $value['name']; ?>" class="col-lg-3 col-md-3 col-sm-3 col-xs-3" data-id="<?php echo $value['name']; ?>">
                	<img class="img-responsive" style="height: 200px; width: 100%;" src="<?php echo "/view/uploads/concours_photos/".$value['id_photo'].".jpg"; ?>">
                	<br>
                	<div>Nom du participant: <?php echo $value['name']; ?></div><br>
			  			<div 
						style="overflow: hidden !important;"
			  			class="fb-like" 
						data-href="<?php echo "/view/uploads/concours_photos/".$value['id_photo'].".jpg"; ?>" 
						data-layout="box_count" 
						data-action="like" 
						data-show-faces="false" 
						data-share="false">
            	</li>
				
			<?php endforeach ?>
			</ul>
		</div>
		<?php //die(); ?>
	<?php endif ?>

</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">              
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
