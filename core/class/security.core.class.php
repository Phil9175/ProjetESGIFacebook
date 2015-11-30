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
	
public static function cleanInput($input){
	 $search = array(
    '@<script[^>]*?>.*?</script>@si',   // On enleve le javascript
    '@<[\/\!]*?[^<>]*?>@si',            // On enleve le html
    '@<style[^>]*?>.*?</style>@siU',    // On enleve le CSS
    '@<![\s\S]*?--[ \t\n\r]*>@'         // On enleve les commentaires
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }
  
  
  public static function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = self::sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
         $output  = self::cleanInput($input);
    }
    return $output;
}
	private function valideEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // si taille email trop grande ou trop petite
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // trop grand ou trop petit nom de domaine
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // commence ou termine par un point
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // deux points consecutifs dans le pre @
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // caractere pas valide
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // deux points consecutifs dans le domaine
         $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // pas bon nom de domaine
         $isValid = false;
      }
   }
   return $isValid;
}
	
	public static function makePassword($pass){
		return sha1($pass);
	}
	
	
}