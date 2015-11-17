
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
	 	$formulaire = new formulaire("addUser", "", "POST", "/admin/users/add", "");
        $formulaire->ajoutElement("Email", "text", "email", "entryInput", "email", "TRUE", "", "", ["email" => ""], "", "");
        $formulaire->ajoutElement("Pseudo", "text", "pseudo", "entryInput", "pseudo", "TRUE", "", "", "", "", "");
		$formulaire->ajoutElement("Mot de passe", "password", "pass", "entryInput", "pass", "TRUE", "", "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les articles", "radio", "set_can_modify_categories", "", "set_can_modify_categories", "", "1", "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les articles", "radio", "set_can_modify_categories", "", "set_can_modify_categories", "", "0", "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les utilisateurs", "radio", "set_can_modify_user", "", "set_can_modify_user", "", "1", "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les utilisateurs", "radio", "set_can_modify_user", "", "set_can_modify_user", "", "0", "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les articles", "radio", "set_can_modify_page", "", "set_can_modify_page", "", "1", "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les articles", "radio", "set_can_modify_page", "", "set_can_modify_page", "", "0", "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les commentaires", "radio", "set_can_modify_commentaire", "", "set_can_modify_commentaire", "", "1", "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les commentaires", "radio", "set_can_modify_commentaire", "", "set_can_modify_commentaire", "", "0", "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier le menu", "radio", "set_can_modify_menu", "", "set_can_modify_menu", "", "1", "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier le lenu", "radio", "set_can_modify_menu", "", "set_can_modify_menu", "", "0", "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les pages", "radio", "set_can_add_page", "", "set_can_add_page", "TRUE", "1", "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les pages", "radio", "set_can_add_page", "", "set_can_add_page", "", "0", "", "", "", "");
		/*$utilisateur->set_can_modify_categories("0");
							$utilisateur->set_can_modify_user("0");
							$utilisateur->set_can_modify_page("0");
							$utilisateur->set_can_modify_commentaire("0");
							$utilisateur->set_can_add_page("0");
							
							*/
        $formulaire->ajoutElement("Enregistrer l'utilisateur", "submit", "enregistrer", "entryInput", "", "", "Enregistrer l'utilisateur", "", "", "", "");
        echo $formulaire->afficheForm();
	
	?>
	</div>
