<?php
class security{
		
	public static function is_connected(){
		if (isset($_SESSION['session'])){
			$utilisateur = new users;
			$utilisateur->getOneBy($_SESSION["session"], "token", "users");
			if (isset($utilisateur->result["id"])){
				if ($utilisateur->result["id"] != 0 && $utilisateur->result["is_banned"] != 1 && $utilisateur->result["is_validate"] == 1){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;	
			}
		}else{
			return FALSE;
		}
	}
	
	public static function returnId(){
		if (self::is_connected()){
			$utilisateur = new users;
			$utilisateur->getOneBy($_SESSION["session"], "token", "users");
			return $utilisateur->result["id"];
		}else{
			return FALSE;
		}
	}
	
	public static function connected($elements){
		//Création d'une variable de session
		//redirection
		$utilisateur = new users;
		$elements = validation::sanitize($elements);
		$utilisateur->getOneBy($elements["email"], "email", "users");
		$utilisateur->setFromBdd($utilisateur->result);
		if ($utilisateur->get_password() == self::makePassword($elements["pass"]) && $utilisateur->get_is_banned() != 1){
			$uniqid = fonctions::id_aleatoire();
			$_SESSION['session'] = $uniqid;
			$_SESSION['nomUtilisateur'] = $utilisateur->get_pseudo();
			$_SESSION['mdp_generate'] = $utilisateur->get_mdp_generate();
			$utilisateur->set_token($uniqid);
			$utilisateur->save("users");
			header('HTTP/1.0 302 Found');
			header("Location: ".ADRESSE_SITE."/admin");
			exit;
		}else{
			self::disconnect();
		}
	}	
	
	public static function disconnect(){
		//Suppression des variables de session
		//redirection
		session_unset();
		session_destroy();
		header('HTTP/1.0 302 Found');
		header("Location: ".ADRESSE_SITE);
		exit;
	}
	
	public static function get_can_modify_categories($id){
			$utilisateur = new users;
			$utilisateur->getOneBy($id, "id", "users");
            $utilisateur->setFromBdd($utilisateur->result);
			if ($utilisateur->get_can_modify_categories() == 1){
				return TRUE;
			}else{
				return FALSE;	
			}
	}
	
	public static function get_can_modify_user($id){
		$utilisateur = new users;
			$utilisateur->getOneBy($id, "id", "users");
            $utilisateur->setFromBdd($utilisateur->result);
			if ($utilisateur->get_can_modify_user() == 1){
				return TRUE;
			}else{
				return FALSE;	
			}
	}
	
	public static function get_can_add_page($id){
		$utilisateur = new users;
			$utilisateur->getOneBy($id, "id", "users");
            $utilisateur->setFromBdd($utilisateur->result);
			if ($utilisateur->get_can_add_page() == 1){
				return TRUE;
			}else{
				return FALSE;	
			}
	}
	
	public static function get_can_modify_page($id){
		$utilisateur = new users;
			$utilisateur->getOneBy($id, "id", "users");
            $utilisateur->setFromBdd($utilisateur->result);
			if ($utilisateur->get_can_modify_page() == 1){
				return TRUE;
			}else{
				return FALSE;	
			}
	}
	
	public static function get_can_modify_commentaire($id){
		$utilisateur = new users;
			$utilisateur->getOneBy($id, "id", "users");
            $utilisateur->setFromBdd($utilisateur->result);
			if ($utilisateur->get_can_modify_commentaire() == 1){
				return TRUE;
			}else{
				return FALSE;	
			}
	}
	
	public static function get_can_modify_menu($id){
		$utilisateur = new users;
			$utilisateur->getOneBy($id, "id", "users");
            $utilisateur->setFromBdd($utilisateur->result);
			if ($utilisateur->get_can_modify_menu() == 1){
				return TRUE;
			}else{
				return FALSE;	
			}
	}
	
	public static function makePassword($pass){
		return sha1($pass);
	}
	
	public static function addAttack(){
		
	}
	
	public static function checkBan(){
		
	}
	
}