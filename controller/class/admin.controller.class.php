<?php
class admin
{
    
   	private $loginUrl;
	private $fb;
	public function __construct() {
		/*session_destroy();
		die('okj');*/
		$this->fb = new Facebook\Facebook([
				'app_id' => APP_ID,
				'app_secret' =>APP_SECRET,
				'default_graph_version' => 'v2.5',
		]);
		if(!isset($_SESSION['facebook_access_token'])){
			$helper = $this->fb->getRedirectLoginHelper();
			$scope =["email","user_likes","user_photos","publish_actions","user_birthday","user_location"];

			$this->loginUrl = $helper->getLoginUrl(ADRESSE_SITE.'login-callback.php',$scope);
		}else{

			$this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

			if(!isset($_SESSION['idParticipant']))
			{
				$response = $this->fb->get('/me', $_SESSION['facebook_access_token']);
				$idParticipant = $response->getDecodedBody()['id'];
				
				$_SESSION['idParticipant'] = $idParticipant;
			}
		}
		
		$requestRoles = $this->fb->get(APP_ID."/roles", APP_TOKEN);
		$roles = $requestRoles->getDecodedBody()['data'];
		$is_admin = FALSE;
		foreach($roles as $key => $value){
			if($value["user"] == $_SESSION['idParticipant'] && $value["role"] == "administrators"){
				$is_admin = TRUE;
				break(1);
			}else{
				continue;
			}
		}
		
		if ($is_admin == FALSE){
			header("Location: ".ADRESSE_SITE);
		}

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
				$concours->setMax_per_page($args['max_per_page']);
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
			$view->assign("max_per_page", $concours->getMax_per_page());
		}
    }
	
	 public function add($args)
    {
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id_participant", "participant");
		$participant->setFromBdd($participant->result);
		if ($participant->getRole() == "admin"){
			if ($args["validation"] == "oui"){
				$concours = new concours();
				$concours->setName($args["nom"]);
				$concours->setDescription($args["description"]);
				sscanf($args["date_debut"], "%2s\/%2s\/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				$concours->setStartDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				sscanf($args["date_fin"], "%2s\/%2s\/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				$concours->setEndDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				$concours->setStatus($args["status"]);
				$concours->setFontColor($args["picker_font"]);
				$concours->setBackgroundColor($args["picker_back"]);
				$concouts->setMax_per_page($args["max_per_page"]);
				$concours->save("concours");
				header("Location: ".ADRESSE_SITE."/admin/");
				exit();
			}
			$view = new view("admin", "concours/add", "admin.layout");

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