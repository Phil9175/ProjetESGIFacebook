
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
	 	$formulaire = new formulaire("editUser", "", "POST", "/admin/users/edit/".$id, "");
        $formulaire->ajoutElement("Email", "text", "email", "entryInput", "email", "TRUE", $email, "", ["email" => ""], "", "");
        $formulaire->ajoutElement("Pseudo", "text", "pseudo", "entryInput", "pseudo", "TRUE", $pseudo, "", "", "", "");
		$formulaire->ajoutElement("Mot de passe", "password", "pass", "entryInput", "pass", "", "", "", "", "", "");

		$checkedCategoriesYes = ($can_modify_categories == 1)?"1\"checked=\"checked":"1";
		$checkedUserYes = ($can_modify_user == 1)?"1\"checked=\"checked":"1";
		$checkedPageYes = ($can_modify_page == 1)?"1\"checked=\"checked":"1";
		$checkedCommentaireYes = ($can_modify_commentaire == 1)?"1\"checked=\"checked":"1";
		$checkedMenuYes = ($can_modify_menu == 1)?"1\"checked=\"checked":"1";
		$checkedPageAddYes = ($can_add_page == 1)?"1\"checked=\"checked":"1";
		$checkedIsValidateYes = ($is_validate == 1)?"1\"checked=\"checked":"1";
		$checkedCategoriesNo = ($can_modify_categories == 0)?"0\"checked=\"checked":"0";
		$checkedUserNo = ($can_modify_user == 0)?"0\"checked=\"checked":"0";
		$checkedPageNo = ($can_modify_page == 0)?"0\"checked=\"checked":"0";
		$checkedCommentaireNo = ($can_modify_commentaire == 0)?"0\"checked=\"checked":"0";
		$checkedMenuNo = ($can_modify_menu == 0)?"1\"checked=\"checked":"1";
		$checkedPageAddNo = ($can_add_page == 0)?"0\"checked=\"checked":"0";
		$checkedIsValidateNo = ($is_validate == 0)?"0\"checked=\"checked":"0";

		$formulaire->ajoutElement("Peut Modifier les articles", "radio", "set_can_modify_categories", "", "set_can_modify_categories", "", $checkedCategoriesYes, "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les articles", "radio", "set_can_modify_categories", "", "set_can_modify_categories", "", $checkedCategoriesNo, "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les utilisateurs", "radio", "set_can_modify_user", "", "set_can_modify_user", "", $checkedUserYes, "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les utilisateurs", "radio", "set_can_modify_user", "", "set_can_modify_user", "", $checkedUserNo, "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les articles", "radio", "set_can_modify_page", "", "set_can_modify_page", "", $checkedPageYes, "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les articles", "radio", "set_can_modify_page", "", "set_can_modify_page", "", $checkedPageNo, "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les commentaires", "radio", "set_can_modify_commentaire", "", "set_can_modify_commentaire", "", $checkedCommentaireYes, "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les commentaires", "radio", "set_can_modify_commentaire", "", "set_can_modify_commentaire", "", $checkedCommentaireNo, "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier le menu", "radio", "set_can_modify_menu", "", "set_can_modify_menu", "", $checkedMenuYes, "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier le menu", "radio", "set_can_modify_menu", "", "set_can_modify_menu", "", $checkedMenuNo, "", "", "", "");
		$formulaire->ajoutElement("Peut Modifier les pages", "radio", "set_can_add_page", "", "set_can_add_page", "", $checkedPageAddYes, "", "", "", "");
		$formulaire->ajoutElement("Ne Peut pas Modifier les pages", "radio", "set_can_add_page", "", "set_can_add_page", "", $checkedPageAddNo, "", "", "", "");
		$formulaire->ajoutElement("Est Validé", "radio", "is_validate", "", "is_validate", "", $checkedIsValidateYes, "", "", "", "");
		$formulaire->ajoutElement("N'est pas validé", "radio", "is_validate", "", "is_validate", "", $checkedIsValidateNo, "", "", "", "");
        $formulaire->ajoutElement("Enregistrer l'utilisateur", "submit", "enregistrer", "entryInput", "", "", "Enregistrer l'utilisateur", "", "", "", "");
        echo $formulaire->afficheForm();
	
	?>
	</div>
