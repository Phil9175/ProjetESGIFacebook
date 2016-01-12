<?php
class admin
{
    
    public $is_connected = false;
    public $securityToken;
    
    public function __construct()
    {
    }
	
	public function defaultPage($args){
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id_participant", "participant");
		$participant->setFromBdd($participant->result);
		if ($participant->getRole() == "admin"){
			$concours = new concours;
			$concourss = $concours->getResults("", "", "concours", ""); 
			$view = new view("admin", "concours/list", "admin.layout");
			$view->assign("concours", $concourss);
		}
		
	}
	
	 public function edit($args)
    {
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id_participant", "participant");
		$participant->setFromBdd($participant->result);
		if ($participant->getRole() == "admin"){
			if ($args["validation"] == "oui"){
				$concours = new concours();
				$concours->getOneBy($args[0], "id", "concours");
				$concours->setFromBdd($concours->result);
				
					$dossier = $_SERVER['DOCUMENT_ROOT'].'/fichiers/';
					$fichier = fonctions::id_aleatoire();
					$taille_maxi = 10000000;
					if ($taille != 0){
						$taille = filesize($_FILES['logo']['tmp_name']);
						$extensions = array('.png', '.gif', '.jpg', '.jpeg');
						$extension = strrchr($_FILES['logo']['name'], '.'); 
						//Début des vérifications de sécurité...
						if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
						{
							 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
						}
						if($taille>$taille_maxi)
						{
							 $erreur = 'Le fichier est trop gros...';
						}
						if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
						{
							 if(move_uploaded_file($_FILES['logo']['tmp_name'], $dossier . $fichier . $extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
							 {
								 $concours->setLogo("/fichiers/".$fichier.".".$extension);
							}
							 else //Sinon (la fonction renvoie FALSE).
							 {
								  echo 'Erreur, merci de réessayer!';
							 }
						}
					}
				$concours->setName($args["nom"]);
				$concours->setDescription($args["description"]);
				$concours->setStartDate($args["date_debut"]);
				$concours->setEndDate($args["date_fin"]);
				$concours->setStatus($args["status"]);
				$concours->setFontColor($args["picker_font"]);
				$concours->save("concours");
			}
			$concours = new concours();
			$concours->getOneBy($args[0], "id", "concours");
			$concours->setFromBdd($concours->result);
			$view = new view("admin", "concours/edit", "admin.layout");
			$view->assign("id", $args[0]);
			$view->assign("nom", $concours->getName());
			$view->assign("description", $concours->getDescription());
			$view->assign("date_debut", $concours->getStartDate());
			$view->assign("date_fin", $concours->getEndDate());
			$view->assign("status", $concours->getStatus());
			$view->assign("font_color", $concours->getFontColor());
			$view->assign("logo", $concours->getLogo());
		}
    }
	
	
    public function list_concours($args)
    {
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id_participant", "participant");
		$participant->setFromBdd($participant->result);
		if ($participant->getRole() == "admin"){
			$concours = new concours;
			$concourss = $concours->getResults("", "", "concours", ""); 
			$view = new view("admin", "concours/list", "admin.layout");
			$view->assign("concours", $concourss);
		}
    }
	
	public function activate($args){
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id_participant", "participant");
		$participant->setFromBdd($participant->result);
		if ($participant->getRole() == "admin"){
			if (is_numeric($args[0])){
				$concours = new concours();
				$concours->getOneBy($args[0], "id", "concours");
				$concours->setFromBdd($concours->result);
				$concours->setStatus(1);
				$concours->save("concours");
				header('Location: /admin');
				exit();
			}
		}
	}
	
	public function deactivate($args){
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id_participant", "participant");
		$participant->setFromBdd($participant->result);
		if ($participant->getRole() == "admin"){
			if (is_numeric($args[0])){
				$concours = new concours();
				$concours->getOneBy($args[0], "id", "concours");
				$concours->setFromBdd($concours->result);
				$concours->setStatus(0);
				$concours->save("concours");
				header('Location: /admin');
				exit();
			}
		}
	}
    
}