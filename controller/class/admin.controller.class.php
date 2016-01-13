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
				
				$concours->setName($args["nom"]);
				$concours->setDescription($args["description"]);
				sscanf($args["date_debut"], "%2s\/%2s\/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				$concours->setStartDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				sscanf($args["date_fin"], "%2s\/%2s\/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				$concours->setEndDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				$concours->setStatus($args["status"]);
				$concours->setFontColor($args["picker_font"]);
				$concours->setBackgroundColor($args["picker_back"]);
				$concours->save("concours");
			}
			$concours = new concours();
			$concours->getOneBy($args[0], "id", "concours");
			$concours->setFromBdd($concours->result);
			$view = new view("admin", "concours/edit", "admin.layout");
			$view->assign("id", $args[0]);
			$view->assign("nom", $concours->getName());
			$view->assign("description", $concours->getDescription());
			sscanf($concours->getStartDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
			$view->assign("date_debut", $jour."/".$mois."/".$an);
			$view->assign("heure_debut", $heure.":".$min.":".$sec);
			sscanf($concours->getEndDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);			
			$view->assign("date_fin", $jour."/".$mois."/".$an);
			$view->assign("heure_fin", $heure.":".$min.":".$sec);
			$view->assign("status", $concours->getStatus());
			$view->assign("font_color", $concours->getFontColor());
			$view->assign("background_color", $concours->getBackgroundColor());
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