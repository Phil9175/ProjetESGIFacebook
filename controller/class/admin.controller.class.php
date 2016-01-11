<?php
class admin
{
    
    public $is_connected = false;
    public $securityToken;
    
    public function __construct()
    {
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
				$concours->save("concours");
			}
			$concours = new concours();
			$concours->getOneBy($args[0], "id", "concours");
			$concours->setFromBdd($concours->result);
			$view = new view("admin","concours/edit");
			$view->assign("id", $args[0]);
			$view->assign("nom", $concours->getName());
			$view->assign("description", $concours->getDescription());
			$view->assign("date_debut", $concours->getStartDate());
			$view->assign("date_fin", $concours->getEndDate());
		}
    }
	
	
    public function listAction($args)
    {
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id_participant", "participant");
		$participant->setFromBdd($participant->result);
		if ($participant->getRole() == "admin"){
			
			$concours = new concours;
			$concourss = $concours->getResults("", "", "concours", ""); 
			$view = new view("admin","concours/list");
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