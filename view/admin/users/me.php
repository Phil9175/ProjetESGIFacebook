
	<div class="moduleCenter">
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
	 	$formulaire = new formulaire("editUser", "", "POST", "/admin/moncompte/edit/".$id, "");
        $formulaire->ajoutElement("Email", "text", "email", "entryInput", "email", "TRUE", $email, "", ["email" => ""], "", "");
        $formulaire->ajoutElement("Pseudo", "text", "pseudo", "entryInput", "pseudo", "TRUE", $pseudo, "", "", "", "");
		$formulaire->ajoutElement("Mot de passe", "password", "pass", "entryInput", "pass", "", "", "", "", "", "");
        $formulaire->ajoutElement("Enregistrer les modifications", "submit", "enregistrer", "entryInput", "", "", "Enregistrer l'utilisateur", "", "", "", "");
        echo $formulaire->afficheForm();
	
	?>
	</div>
