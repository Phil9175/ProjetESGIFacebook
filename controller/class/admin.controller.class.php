<?php
class admin
{
    
    public $is_connected = false;
    public $securityToken;
    
    public function __construct()
    {
    }
    
    public function listAction($args)
    {
		$view = new view("admin","concours/list");
    }
    
    public function auth($args)
    {
		if (isset($args['isSubmit']) && $args['isSubmit'] == "yes") {
			$validation = new validation($_SESSION['elementsSessionFormulaire']['identificationAdmin'], $args);
			if ($validation->validationFormulaire() === TRUE) {
				security::connected($args);
			} else {
				$view = new view("admin", "auth", "admin.notconnected.layout");
				$view->assign("meta_title", "Connexion Administration");
				$view->assign("meta_description", "Connexion administration journal du referencement");
				$view->assign("errors", $validation->getErreur());
			}
		} else {
				$view = new view("admin", "auth", "admin.notconnected.layout");
				$view->assign("meta_title", "Connexion Administration");
				$view->assign("meta_description", "Connexion administration journal du referencement");
		}
    }
    
	public function page($args){
		if (security::get_can_add_page(security::returnId())){
			if ($args[0] == "list") {
				$view     = new view("admin", "page/list", "admin.layout");
				$article  = new article;
				$articles = $article->getResults("", "", "article", "WHERE type_page = 'page.layout' ORDER BY id");
				$view->assign("allArticles", $articles);
				$view->assign("meta_title", "Tout les articles");
				$view->assign("meta_description", "Tout les articles");
			}else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
		}else{
			header('HTTP/1.0 302 Found');
			header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
			exit;
		}
	}
	
    public function article($args)
    {
        if (security::is_connected() === TRUE) {
			if (security::get_can_modify_page(security::returnId()) || security::get_can_add_page(security::returnId())){
            //AJOUT ARTICLE
				if ($args[0] == "add") {
					$view = new view("admin", "article/add", "admin.layout");
					if (isset($args['isSubmit']) && $args['isSubmit'] == "yes") {
						$validation = new validation($_SESSION['elementsSessionFormulaire']['addArticle'], $args);
						if ($validation->validationFormulaire() === TRUE) {
							$article = new article;
							$article->getOneBy(validation::sanitize($args['url']), "article_url", "article", "ORDER BY id");
							$article->setFromBdd($article->result);
							if (is_numeric($article->get_id())){
								$errors[] = "Un article existe deja avec cette URL";
								$view->assign("errors", $errors);
							}else{
								unset($article);
								$user = new users();
								$user->getOneBy($_SESSION['session'], "token", "users");
								$user->setFromBdd($user->result);
								$article = new article;
								$article->set_titre(validation::sanitize($args["titre"]));
								$article->set_contenu(fonctions::format($args["contenu"], "<br />", ""));
								$article->set_statut("published");
								$article->set_meta_title(validation::sanitize($args["meta_title"]));
								$article->set_meta_description(validation::sanitize($args["meta_description"]));
								$article->set_date_publication(date("Y-m-d H:i:s"));
								$article->set_date_last_modification(date("Y-m-d H:i:s"));
								if (security::get_can_modify_page(security::returnId()) && security::get_can_add_page(security::returnId())){
									if ($args['pageouarticle'] == "article"){
										$article->set_type_page("article.layout");
									}else{
										$article->set_type_page("page.layout");
									}
								}elseif (security::get_can_modify_page(security::returnId()) && !security::get_can_add_page(security::returnId())){
										$article->set_type_page("article.layout");
								}elseif (!security::get_can_modify_page(security::returnId()) && security::get_can_add_page(security::returnId())){
										$article->set_type_page("page.layout");
								}
								
								$article->set_idmembre($user->get_id());
								$article->set_keyword(validation::sanitize($args["keyword"]));
								$article->set_article_url(validation::sanitize(fonctions::remove_accents(str_replace("/", "-", str_replace(".", "-", trim($args['url']))))));
								$article->set_tags(validation::sanitize($args["tags"]));
								$article->save("article");
							}
						} else {
							print_r($validation->getErreur());
							$view->assign("errors", $validation->getErreur());
							$view->assign("tempTitle", $args["titre"]);
							$view->assign("tempContenu", $args["contenu"]);
							$view->assign("tempUrl", $args["url"]);
							$view->assign("tempTags", $args["tags"]);
							$view->assign("tempMetaTitle", $args["meta_title"]);
							$view->assign("tempMetaDescription", $args["meta_description"]);
							$view->assign("tempkeyword", $args["keyword"]);
							
						}
					}
					$view->assign("meta_title", "Ajout article");
					$view->assign("meta_description", "Ajout article");
										
					//MODIFICATION ET LISTE ARTICLES
				} elseif ($args[0] == "list") {
					if (security::get_can_modify_page(security::returnId())){
					$view     = new view("admin", "article/list", "admin.layout");
					$article  = new article;
					$articles = $article->getResults("", "", "article", "WHERE type_page = 'article.layout' ORDER BY id");
					$view->assign("allArticles", $articles);
					
					$view->assign("meta_title", "Tout les articles");
					$view->assign("meta_description", "Tout les articles");
					}else{
						header('HTTP/1.0 302 Found');
						header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
						exit;
					}
				} elseif ($args[0] == "edit") {
					$view    = new view("admin", "article/edit", "admin.layout");
					$article = new article;
					$article->getOneBy(intval($args[1]), "id", "article", "ORDER BY id");
					$article->setFromBdd($article->result);
					if ((security::get_can_modify_page(security::returnId()) && $article->get_type_page() == "article.layout") || (security::get_can_add_page(security::returnId()) && $article->get_type_page() == "page.layout")){
						if (isset($args['isSubmit']) && $args['isSubmit'] == "yes" && is_numeric($args[1])) {
							$validation = new validation($_SESSION['elementsSessionFormulaire']['editArticle'], $args);
							if ($validation->validationFormulaire() === TRUE) {
								$user = new users();
								$user->getOneBy($_SESSION['session'], "token", "users");
								$user->setFromBdd($user->result);
								$article = new article;
								$article->getOneBy(validation::sanitize($args['url']), "article_url", "article", "ORDER BY id");
								$article->setFromBdd($article->result);
								if (is_numeric($article->get_id()) && $article->get_id() != intval($args[1])){
									$errors[] = "Un article existe deja avec cette URL";
									$view->assign("errors", $errors);
								}else{
									unset($article);
									$article = new article;
									$article->getOneBy(intval($args[1]), "id", "article", "ORDER BY id");
									$article->setFromBdd($article->result);
									$article->set_titre(validation::sanitize($args["titre"]));
									$article->set_contenu(fonctions::format($args["contenu"], "<br />", ""));
									$article->set_statut("published");
									$article->set_meta_title(validation::sanitize($args["meta_title"]));
									$article->set_meta_description(validation::sanitize($args["meta_description"]));
									$article->set_date_last_modification(date("Y-m-d H:i:s"));
									if (security::get_can_modify_page(security::returnId()) && security::get_can_add_page(security::returnId())){
										if ($args['pageouarticle'] == "article"){
											$article->set_type_page("article.layout");
										}else{
											$article->set_type_page("page.layout");
										}
									}elseif (security::get_can_modify_page(security::returnId()) && !security::get_can_add_page(security::returnId())){
											$article->set_type_page("article.layout");
									}elseif (!security::get_can_modify_page(security::returnId()) && security::get_can_add_page(security::returnId())){
											$article->set_type_page("page.layout");
									}
									$article->set_tags(validation::sanitize($args["tags"]));
									$article->set_idmembre($user->get_id());
									$article->set_keyword(validation::sanitize($args["keyword"]));
									$article->set_article_url(validation::sanitize(fonctions::remove_accents(str_replace("/", "-", str_replace(".", "-", trim($args['url']))))));
									$article->save("article");
								}
								$view->assign("errors", $validation->getErreur());
							} else {
								$view->assign("errors", $validation->getErreur());
							}
							$article->getOneBy(intval($args[1]), "id", "article", "ORDER BY id");
							$article->setFromBdd($article->result);
							$view->assign("id", $article->get_id());
							$view->assign("titre", $article->get_titre());
							$view->assign("contenu", $article->get_contenu());
							$view->assign("formmeta_title", $article->get_meta_title());
							$view->assign("formmeta_description", $article->get_meta_description());
							$view->assign("article_url", $article->get_article_url());
							$view->assign("date_publication", $article->get_date_publication());
							$view->assign("date_last_modification", $article->get_date_last_modification());
							$view->assign("tags", $article->get_tags());
							$view->assign("keyword", $article->get_keyword());
							$view->assign("pageouarticle", $article->get_type_page());
						} else {
							$article->getOneBy(intval($args[1]), "id", "article", "ORDER BY id");
							$article->setFromBdd($article->result);
							$view->assign("id", $article->get_id());
							$view->assign("titre", $article->get_titre());
							$view->assign("contenu", $article->get_contenu());
							$view->assign("formmeta_title", $article->get_meta_title());
							$view->assign("formmeta_description", $article->get_meta_description());
							$view->assign("article_url", $article->get_article_url());
							$view->assign("date_publication", $article->get_date_publication());
							$view->assign("date_last_modification", $article->get_date_last_modification());
							$view->assign("tags", $article->get_tags());
							$view->assign("keyword", $article->get_keyword());
							$view->assign("pageouarticle", $article->get_type_page());
						}
					}else{
						header('HTTP/1.0 302 Found');
						header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
						exit;
					}
					$view->assign("meta_title", "Modification article");
					$view->assign("meta_description", "Modification article");
				}
			}else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
        } else {
            $view = new view("admin", "auth", "admin.notconnected.layout");
            $view->assign("meta_title", "Connexion Administration");
            $view->assign("meta_description", "Connexion administration journal du referencement");
        }
    }
    
    public function disconnect()
    {
        security::disconnect();
    }
    
	public function unpublished($args){
		if (security::is_connected() === TRUE) {
			if (security::get_can_modify_page(security::returnId())){
				$article = new article("article");
				$article->getOneBy(intval($args[0]), "id", "article");
				$article->setFromBdd($article->result);
				$article->set_statut("unpublished");
				$article->save("article");
				header('HTTP/1.0 302 Found');
				header("Location: ".ADRESSE_SITE."/admin/article/list");
				exit;
			}else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
		}
	}
	
	public function published($args){
		if (security::is_connected() === TRUE) {
			if (security::get_can_modify_page(security::returnId())){
				$article = new article("article");
				$article->getOneBy(intval($args[0]), "id", "article");
				$article->setFromBdd($article->result);
				$article->set_statut("published");
				$article->save("article");
				header('HTTP/1.0 302 Found');
				header("Location: ".ADRESSE_SITE."/admin/article/list");
				exit;
			}else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
		}
	}
	
	public function users($args){
		if (security::is_connected() === TRUE) {
			if (security::get_can_modify_user(security::returnId())){
				if ($args[0] == "list"){
					$view  = new view("admin", "users/list", "admin.layout");
					$user  = new users;
					$users = $user->getResults("", "", "users", "ORDER BY id");
					$view->assign("users", $users);
					
					$view->assign("meta_title", "Liste des utilisateurs");
					$view->assign("meta_description", "liste des utilisateurs");
					
				}elseif ($args[0] == "add"){
					$view  = new view("admin", "users/add", "admin.layout");
					
					$view->assign("meta_title", "Ajout utilisateur");
					$view->assign("meta_description", "Ajout utilisateur");
					if (isset($args['isSubmit']) && $args['isSubmit'] == "yes") {
						$validation = new validation($_SESSION['elementsSessionFormulaire']['addUser'], $args);
						if ($validation->validationFormulaire() === TRUE) {
							$nbErreurs = 0;
							$selectUser = new users;
							$selectUser->getOneBy($args['pseudo'], "pseudo", "users");
							$selectUser->setFromBdd($selectUser->result);				
							if (is_numeric($selectUser->get_id())){
								$errors[] = "Un utilisateur existe deja avec ce pseudo";
								$nbErreurs++;
							}
							unset($selectUser);
							$selectUser = new users;
							$selectUser->getOneBy($args['email'], "email", "users");
							$selectUser->setFromBdd($selectUser->result);				
							if (is_numeric($selectUser->get_id())){
								$errors[] = "Un utilisateur existe deja avec cet email";
								$nbErreurs++;
							}
							if ($nbErreurs == 0){
							$utilisateur = new users;
							$utilisateur->set_pseudo(validation::sanitize($args['pseudo']));
							$utilisateur->set_email($args['email']);
							$utilisateur->set_date_inscription(date('Y-m-d H:i:s'));
							$utilisateur->set_password(security::makePassword($args['pass']));
							$utilisateur->set_can_modify_categories($args['set_can_modify_categories']);
							$utilisateur->set_can_modify_user($args['set_can_modify_user']);
							$utilisateur->set_can_modify_page($args['set_can_modify_page']);
							$utilisateur->set_can_modify_commentaire($args['set_can_modify_commentaire']);
							$utilisateur->set_can_modify_menu($args['set_can_modify_menu']);
							$utilisateur->set_can_add_page($args['set_can_add_page']);
							$utilisateur->set_is_validate($args['set_is_validate']);
							$utilisateur->set_is_validate(1);
							$utilisateur->set_is_banned(0);
							$utilisateur->set_mdp_generate(0);
							$utilisateur->save("users");
							}else{
							$view->assign("errors", $errors);
							}
						}else{
							$view->assign("errors", $validation->getErreur());

						}
					}
				}elseif ($args[0] == "edit"){
						$view  = new view("admin", "users/edit", "admin.layout");
						
						$view->assign("meta_title", "Modification utilisateur");
						$view->assign("meta_description", "Modification utilisateur");
					if (isset($args['isSubmit']) && $args['isSubmit'] == "yes") {
						$validation = new validation($_SESSION['elementsSessionFormulaire']['editUser'], $args);
						if ($validation->validationFormulaire() === TRUE) {
							$nbErreurs = 0;
							$selectUser = new users;
							$selectUser->getOneBy($args['pseudo'], "pseudo", "users");
							$selectUser->setFromBdd($selectUser->result);				
							if (is_numeric($selectUser->get_id()) && $selectUser->get_id() != intval($args[1])){
								$errors[] = "Un utilisateur existe deja avec ce pseudo";
								$nbErreurs++;
							}
							unset($selectUser);
							$selectUser = new users;
							$selectUser->getOneBy($args['email'], "email", "users");
							$selectUser->setFromBdd($selectUser->result);				
							if (is_numeric($selectUser->get_id()) && $selectUser->get_id() != intval($args[1])){
								$errors[] = "Un utilisateur existe deja avec cet email";
								$nbErreurs++;
							}
							if ($nbErreurs == 0){
								unset($selectUser);
								$selectUser = new users;
								$selectUser->getOneBy(intval($args['1']), "id", "users");
								$selectUser->setFromBdd($selectUser->result);	
								$utilisateur = new users;
								$utilisateur->set_id($selectUser->get_id());
								$utilisateur->set_pseudo(validation::sanitize($args['pseudo']));
								$utilisateur->set_email($args['email']);
								$utilisateur->set_date_inscription($selectUser->Get_date_inscription());
								if ($args['pass'] != ""){
									$utilisateur->set_password(security::makePassword($args['pass']));
								}else{
									$utilisateur->set_password($selectUser->get_password());
								}
								$utilisateur->set_can_modify_categories($args['set_can_modify_categories']);
								$utilisateur->set_can_modify_user($args['set_can_modify_user']);
								$utilisateur->set_can_modify_page($args['set_can_modify_page']);
								$utilisateur->set_can_modify_commentaire($args['set_can_modify_commentaire']);
								$utilisateur->set_can_add_page($args['set_can_add_page']);
								$utilisateur->set_can_modify_menu($args['set_can_modify_menu']);
								$utilisateur->set_token($selectUser->get_token());
								$utilisateur->set_is_banned($selectUser->get_is_banned());
								$utilisateur->set_is_validate($args['is_validate']);
								$utilisateur->set_mdp_generate($selectUser->get_mdp_generate());
								$utilisateur->save("users");
							}else{
							$view->assign("errors", $errors);
							}
						}else{
							$view->assign("errors", $validation->getErreur());

						}
					}
					$utilisateurAModifier = new users;
					$utilisateurAModifier->getOneBy(intval($args[1]), "id", "users", "ORDER BY id");
					$utilisateurAModifier->setFromBdd($utilisateurAModifier->result);
					$view->assign("id", $utilisateurAModifier->get_id());
					$view->assign("pseudo", $utilisateurAModifier->get_pseudo());
					$view->assign("email", $utilisateurAModifier->get_email());
					$view->assign("can_modify_categories", $utilisateurAModifier->get_can_modify_categories());
					$view->assign("can_modify_user", $utilisateurAModifier->get_can_modify_user());
					$view->assign("can_modify_page", $utilisateurAModifier->get_can_modify_page());
					$view->assign("can_modify_commentaire", $utilisateurAModifier->get_can_modify_commentaire());
					$view->assign("can_modify_menu", $utilisateurAModifier->get_can_modify_menu());
					$view->assign("can_add_page", $utilisateurAModifier->get_can_add_page());
					$view->assign("is_validate", $utilisateurAModifier->get_is_validate());
				}
			}else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
		}
	}
	
	public function addRights($args){
		if (security::is_connected() === TRUE) {
			if (security::get_can_modify_user(security::returnId()) && is_numeric($args[1])){
				if ($args[0] == "user"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_user("1");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "commentaire"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_commentaire("1");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "page"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_page("1");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "categories"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_categories("1");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "menu"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_menu("1");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "pageAdd"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_add_page("1");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "banned"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_is_banned("1");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				
			}else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
		}
	}

	public function removeRights($args){
		if (security::is_connected() === TRUE) {
			if (security::get_can_modify_user(security::returnId()) && is_numeric($args[1])){
				if ($args[0] == "user"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_user("0");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "commentaire"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_commentaire("0");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "page"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_page("0");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "categories"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_categories("0");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "menu"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_modify_menu("0");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "pageAdd"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_can_add_page("0");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
				if ($args[0] == "banned"){
					$user = new users();
					$user->getOneBy(intval($args[1]), "id", "users");
					$user->setFromBdd($user->result);
					$user->set_is_banned("0");
					$user->save("users");
					header('HTTP/1.0 302 Found');
					header("Location: ".ADRESSE_SITE."/admin/users/list");
					exit;
				}
			}else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
		}
	}
	
	public function moncompte($args){
		if (isset($args[1])){
			if (security::is_connected() === TRUE) {
					if ($args[0] == "edit"){
							$view  = new view("admin", "users/me", "admin.layout");
							$view->assign("meta_title", "Modification utilisateur");
							$view->assign("meta_description", "Modification utilisateur");
						if (isset($args['isSubmit']) && $args['isSubmit'] == "yes") {
							$validation = new validation($_SESSION['elementsSessionFormulaire']['editUser'], $args);
							if ($validation->validationFormulaire() === TRUE) {
								$nbErreurs = 0;
								$selectUser = new users;
								$selectUser->getOneBy($args['pseudo'], "pseudo", "users");
								$selectUser->setFromBdd($selectUser->result);				
								if (is_numeric($selectUser->get_id()) && $selectUser->get_id() != intval(security::returnId())){
									$errors[] = "Un utilisateur existe deja avec ce pseudo";
									$nbErreurs++;
								}
								unset($selectUser);
								$selectUser = new users;
								$selectUser->getOneBy($args['email'], "email", "users");
								$selectUser->setFromBdd($selectUser->result);				
								if (is_numeric($selectUser->get_id()) && $selectUser->get_id() != intval(security::returnId())){
									$errors[] = "Un utilisateur existe deja avec cet email";
									$nbErreurs++;
								}
								if ($nbErreurs == 0){
									unset($selectUser);
									$selectUser = new users;
									$selectUser->getOneBy(intval(security::returnId()), "id", "users");
									$selectUser->setFromBdd($selectUser->result);	
									$utilisateur = new users;
									$utilisateur->set_id($selectUser->get_id());
									$utilisateur->set_pseudo(validation::sanitize($args['pseudo']));
									$utilisateur->set_email($args['email']);
									$utilisateur->set_date_inscription($selectUser->Get_date_inscription());
									if ($args['pass'] != ""){
										$utilisateur->set_password(security::makePassword($args['pass']));
										$_SESSION['mdp_generate'] = 0;
										$utilisateur->set_mdp_generate("0");
									}else{
										$utilisateur->set_password($selectUser->get_password());
									}
									$utilisateur->set_can_modify_categories($selectUser->get_can_modify_categories());
									$utilisateur->set_can_modify_user($selectUser->get_can_modify_user());
									$utilisateur->set_can_modify_page($selectUser->get_can_modify_page());
									$utilisateur->set_can_modify_commentaire($selectUser->get_can_modify_commentaire());
									$utilisateur->set_can_modify_menu($selectUser->get_can_modify_menu());
									$utilisateur->set_can_add_page($selectUser->get_can_add_page());
									$utilisateur->set_is_banned($selectUser->get_is_banned());
									$utilisateur->set_is_validate($selectUser->get_is_validate());
									$utilisateur->set_token($selectUser->get_token());
									$utilisateur->save("users");
								}else{
								$view->assign("errors", $errors);
								}
							}else{
								$view->assign("errors", $validation->getErreur());
							}
						}
						$utilisateurAModifier = new users;
						$utilisateurAModifier->getOneBy(security::returnId(), "id", "users", "ORDER BY id");
						$utilisateurAModifier->setFromBdd($utilisateurAModifier->result);
						$view->assign("id", $utilisateurAModifier->get_id());
						$view->assign("pseudo", $utilisateurAModifier->get_pseudo());
						$view->assign("email", $utilisateurAModifier->get_email());
					}
				}else{
					header('HTTP/1.0 302 Found');
					header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
					exit;
				}
		}else{
			header('HTTP/1.0 302 Found');
			header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
			exit;
		}
	}
	
	public function menu($args){
		 if (security::is_connected() === TRUE && security::get_can_modify_menu(security::returnId())){
            $view = new view("admin", "menu/edit", "admin.layout");
            $view->assign("meta_title", "Administration");
            $view->assign("meta_description", "Administration journal du referencement");
			
			$date = date('Y-m-d H:i:s');
			$i=0;
			if (isset($args['tab'])) {
				foreach($args['tab'] as $key => $value){
					$menu = new menu();
					$cle = (is_numeric($key))?$key:"";
					$menu->set_id($cle);
					$menu->set_nom($value['nom']);
					$menu->set_place($i);
					$menu->set_lien($value['lien']);
					$menu->set_isChildOf($value['isChildOf']);
					$menu->set_maj($date);
					$menu->save("menu");
					unset($menu);
					$i++;
				}
				$menu = new menu();
				$menu->requeteDelete("DELETE FROM menu WHERE maj != '".$date."'");
				unset($menu);
				
			}
            
        }else{
				header('HTTP/1.0 302 Found');
				header("Location : ".ADRESSE_SITE."/admin/disconnect"); 
				exit;
			}
		
		
		
		
	}
	
	
	
	
	
}