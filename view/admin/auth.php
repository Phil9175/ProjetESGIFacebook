
	<div class="moduleCenter">
      <h3>Se connecter</h3>
      <ul>
      <?php if (isset($_POST['isSubmit'])):
	  				if (isset($errors)):
		  			foreach($errors as $key => $values):
			?>
            <li><?php echo $values; ?>
            <?php 
					endforeach; 
				endif;
			endif;
			?>
      </ul>
      <?php
	  if (security::is_connected() === TRUE) {
		  
	  }else{
        $formulaire = new formulaire("identificationAdmin", "", "POST", "/admin/auth", "");
        $formulaire->ajoutElement("Email", "text", "email", "", "email", "TRUE", "", "", ["email" => ""], "", "");
		$formulaire->ajoutElement("Mot de passe", "password", "pass", "", "pass", "TRUE", "", "", "", "", "");
        $formulaire->ajoutElement("Se connecter", "submit", "rechercher", "", "", "", "Se connecter", "", "", "", "");
        echo $formulaire->afficheForm();
	  }
        ?>
    </div>

