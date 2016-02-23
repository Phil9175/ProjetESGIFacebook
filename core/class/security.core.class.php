<?php
class security{
	public static function checkConcours(){
		$leConcours = new concours;
		// On sélectionne le concours ouvert
		$leConcours->getOneBy(1, "status", "concours");
		$leConcours->setFromBdd($leConcours->result);

		if($leConcours->getId() != ""){
			sscanf($leConcours->getStartDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
			$date_debut = $an.$mois.$jour.$heure.$min.$sec;
			sscanf($leConcours->getEndDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);			
			$date_fin = $an.$mois.$jour.$heure.$min.$sec;
			$date = date("YmdHis");
			if ($date>$date_debut && $date<$date_fin){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	
	public static function getLogo(){
		$leConcours = new concours;
		// On sélectionne le concours ouvert
		$leConcours->getOneBy(1, "status", "concours");
		$leConcours->setFromBdd($leConcours->result);

		if($leConcours->getId() != ""){
			sscanf($leConcours->getStartDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
			$date_debut = $an.$mois.$jour.$heure.$min.$sec;
			sscanf($leConcours->getEndDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);			
			$date_fin = $an.$mois.$jour.$heure.$min.$sec;
			$date = date("YmdHis");
			if ($date>$date_debut && $date<$date_fin){
				return $leConcours->getLogo();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
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
	
	
}