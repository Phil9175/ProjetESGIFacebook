<?php
class admin
{
   	private $loginUrl;
	private $fb;
	private $is_admin = FALSE;
	private $logo;
	
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
			$this->loginUrl = $helper->getLoginUrl(ADRESSE_SITE.'callback/',$scope);
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
		foreach($roles as $key => $value){
			if($value["user"] == $_SESSION['idParticipant']){
				if ($value["role"] == "administrators"){
					$this->is_admin = TRUE;
					break(1);
				}
			}
		}
		if ($this->is_admin == FALSE){
			header("Location: ".ADRESSE_SITE);
		}
		/*
		$facebookApp = $this->fb;
		$app_id = APP_ID;
		$app_secret = APP_SECRET;
		$app_access_token = $app_id . '|' . $app_secret;
		$response = $facebookApp->post( '/1654683138137649/notifications', array(
						'template' => 'You have received a new message.',
						'href' => 'RELATIVE URL'
					) );    
		print_r($response);
		*/
		
		$settings = new settings();
		$settings->getOneBy(1, "id", "settings");
		$settings->setFromBdd($settings->result);
		define("LOGO", $settings->get_logo_societe(), TRUE);

	}
	
	public function defaultPage($args){
		if ($this->is_admin == TRUE){
			$concours = new concours;
			$concourss = $concours->getResults("", "", "concours", ""); 
			$view = new view("admin", "concours/list", "admin.layout");
			$view->assign("concours", $concourss);
		}
		
	}
	
	 public function edit($args){
		if ($this->is_admin == TRUE){
			if (isset($args["validation"]) && $args["validation"] == "oui"){
				$concours = new concours();
				$concours->getOneBy($args[0], "id", "concours");
				$concours->setFromBdd($concours->result);
				
				$concours->setName($args["nom"]);
				$concours->setDescription($args["description"]);
				sscanf($args["date_debut"], "%2s/%2s/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				$concours->setStartDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				sscanf($args["date_fin"], "%2s/%2s/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				$concours->setEndDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				
				$testConcours = new concours();
				$testConcours->getOneBy(1, "status", "concours");
				$testConcours->setFromBdd($testConcours->result);
				if ($testConcours->getId() == "" && $args["status"] == 1 && $testConcours->getId() != $args[0]){
					unset($testConcours);
					$concours->setStatus(1);
				}elseif ($args["status"] == 0){
					unset($testConcours);
					$concours->setStatus(0);
				}
				$concours->setFontColor($args["picker_font"]);
				$concours->setBackgroundColor($args["picker_back"]);
				$concours->setMax_per_page($args['max_per_page']);
				$concours->save("concours");
			}
			
			
			if (isset($args[1]) && $args[1] == "picture"){
				$dossier = $_SERVER['DOCUMENT_ROOT'].'/fichiers/';
						$fichier = fonctions::id_aleatoire();
						$taille_maxi = 10000000;
						$taille = filesize($_FILES['user_photo']['tmp_name']);
						$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.svg');
						$extension = strrchr($_FILES['user_photo']['name'], '.'); 
						//Début des vérifications de sécurité...
						if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
						{
							 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
						}
						if($taille>$taille_maxi)
						{
							 $erreur = 'Le fichier est trop gros...';
						}
						if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
						{
							 if(move_uploaded_file($_FILES['user_photo']['tmp_name'], $dossier . $fichier . $extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
							 {
								 $concours = new concours();
								 $concours->getOneBy($args[0], "id", "concours");
								 $concours->setFromBdd($concours->result);
								 $settings->set_logo_societe('/fichiers/'.$fichier . $extension);
								 $concours->save("concours");
								 $_SESSION['errors'][] = ["type" => "success", "message" => "Le logo a bien ete modifié."];
								header('Location: '.ADRESSE_SITE.'admin/edit/'.$args[1]);
							}
							 else //Sinon (la fonction renvoie FALSE).
							 {
								  echo 'Erreur, merci de réessayer!';
							 }
						}
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
	
	 public function add($args){
		if ($this->is_admin == TRUE){
			if (isset($args["validation"]) && $args["validation"] == "oui"){
				$concours = new concours();
				$concours->setName($args["nom"]);
				$concours->setDescription($args["description"]);
				sscanf($args["date_debut"], "%2s/%2s/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				mail("philgranger@orange.fr", "test", $jour.$mois.$an.$heure.$min.$sec);
				$concours->setStartDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				sscanf($args["date_fin"], "%2s/%2s/%4s %2s:%2s:%2s", $jour, $mois, $an, $heure, $min, $sec);
				$concours->setEndDate($an."-".$mois."-".$jour." ".$heure.":".$min.":".$sec);
				
				$testConcours = new concours();
				$testConcours->getOneBy(1, "status", "concours");
				$testConcours->setFromBdd($testConcours->result);
				if ($testConcours->getId() == "" && $args["status"] == 1){
					unset($testConcours);
					$concours->setStatus(1);
					$_SESSION['errors'][] = ["type" => "success", "message" => "Le concours a ete active."];
				}elseif ($args["status"] == 0){
					unset($testConcours);
					$concours->setStatus(0);
					$_SESSION['errors'][] = ["type" => "danger", "message" => "Le concours n'a pas pu etre activé."];
				}
				
				$concours->setFontColor($args["picker_font"]);
				$concours->setBackgroundColor($args["picker_back"]);
				$concours->setMax_per_page($args["max_per_page"]);
				$id = $concours->save("concours");
				$_SESSION['errors'][] = ["type" => "success", "message" => "Le concours a bien ete ajoute."];
				header("Location: ".ADRESSE_SITE."/admin/edit/".$id);
				exit();
			}
			$view = new view("admin", "concours/add", "admin.layout");
		}
    }
	
	
	
	
    public function list_concours($args){
		if ($this->is_admin == TRUE){
			$concours = new concours;
			$concourss = $concours->getResults("", "", "concours", ""); 
			$view = new view("admin", "concours/list", "admin.layout");
			$view->assign("concours", $concourss);
		}
    }
	
	public function activate($args){
		if ($this->is_admin == TRUE){
			if (is_numeric($args[0])){
				$concours = new concours();
				$concours->getOneBy(0, "status", "concours");
				$concours->setFromBdd($concours->result);
				if ($concours->getId() == ""){
					unset($concours);
					$concours = new concours();
					$concours->getOneBy($args[0], "id", "concours");
					$concours->setFromBdd($concours->result);
					$concours->setStatus(1);
					$concours->save("concours");
				}
				header('Location: /admin');
				exit();
			}
		}
	}
	
	public function deactivate($args){
		if ($this->is_admin == TRUE){
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
	
	public function settings($args){
		if ($this->is_admin == TRUE){
			if(isset($args[0]) && $args[0] == "picture"){
						$dossier = $_SERVER['DOCUMENT_ROOT'].'/fichiers/';
						$fichier = fonctions::id_aleatoire();
						$taille_maxi = 10000000;
						$taille = filesize($_FILES['user_photo']['tmp_name']);
						$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.svg');
						$extension = strrchr($_FILES['user_photo']['name'], '.'); 
						//Début des vérifications de sécurité...
						if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
						{
							 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
						}
						if($taille>$taille_maxi)
						{
							 $erreur = 'Le fichier est trop gros...';
						}
						if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
						{
							 if(move_uploaded_file($_FILES['user_photo']['tmp_name'], $dossier . $fichier . $extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
							 {
								 $settings = new settings();
								 $settings->getOneBy(1, "id", "settings");
								 $settings->setFromBdd($settings->result);
								 $settings->set_logo_societe('/fichiers/'.$fichier . $extension);
								 $settings->save("settings");
								 $_SESSION['errors'][] = ["type" => "success", "message" => "Le logo a bien ete modifié."];
								header('Location: '.ADRESSE_SITE.'admin/settings/#tab_1_2');
							}
							 else //Sinon (la fonction renvoie FALSE).
							 {
								  echo 'Erreur, merci de réessayer!';
							 }
						}
			}elseif (isset($args[0]) && $args[0] == "informations"){
				//set des informations de societe
				$settings = new settings();
				$settings->getOneBy(1, "id", "settings");
				$settings->setFromBdd($settings->result);
				$settings->set_nom_societe($args["nom_societe"]);
				$settings->set_mail_host($args["mail_host"]);
				$settings->set_mail_port($args["mail_port"]);
				$settings->set_mail_username($args["mail_username"]);
				$settings->set_mail_password($args["mail_password"]);
				$settings->save("settings");
				$_SESSION['errors'][] = ["type" => "success", "message" => "Les informations ont bien été modifiées."];
				header('Location: '.ADRESSE_SITE.'admin/settings/#tab_1_1');
			}
					
			$view = new view("admin", "settings/edit", "admin.layout");
			$settings = new settings;
			$settings->getOneBy(1, "id", "settings");
			$settings->setFromBdd($settings->result);
			$view->assign("nom_societe", $settings->get_nom_societe());
			$view->assign("mail_host", $settings->get_mail_host());
			$view->assign("mail_port", $settings->get_mail_port());
			$view->assign("mail_username", $settings->get_mail_username());
			$view->assign("mail_password", $settings->get_mail_password());
			$view->assign("logo_societe", $settings->get_logo_societe());
			
		}
	}
	
	public function utilisateurs($args){
		if (!$args[0]){
			$view = new view("admin", "utilisateurs/list_concours", "admin_table.layout");
		}elseif ($args[0] == "list_users"){
			if (!$args[1]) {
				$view = new view("admin", "utilisateurs/list_users", "admin_table_users.layout");
			}else{
				$view = new view("admin", "utilisateurs/list_users_concours", "admin_table_users_concours.layout");
				$view->assign("id", $args[1]);
			}
		}
	}
    
	public function liste($args){
		if ($args[0] == "users"){
				$participant = new participant;
				$participants = $participant->requete("SELECT COUNT(*) FROM participant");
				$iTotalRecords  = $participants[0]["COUNT(*)"];
				unset($participants);
				unset($participant);
				
				$iDisplayLength = intval($_REQUEST['length']);
				$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
				$iDisplayStart  = intval($_REQUEST['start']);
				$sEcho          = intval($_REQUEST['draw']);
				$end = $iDisplayStart + $iDisplayLength;
				$end = $end > $iTotalRecords ? $iTotalRecords : $end;
				$participant = new participant;
				$participants = $participant->requete("SELECT * FROM participant ORDER BY id DESC LIMIT ".$iDisplayStart.", ".$iDisplayLength."");
				
				$records         = array();
			$records["data"] = array();
			
			foreach ($participants as $key => $value) {
				list($annee, $mois, $jour) = explode("-", $value["birthdate"]);
				$genre = ($value["gender"] == 1)?"Homme":"Femme";
				$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$value["id"].'">',
			  $value["first_name"],
			  $value["last_name"],
			$genre,
			  $value["email"],
			  $jour."/".$mois."/".$annee
		   );
				
			}
			
			if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				$records["customActionStatus"]  = "OK"; // pass custom message(useful for getting status of group actions)
				$records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
			}
			
			$records["draw"]            = $sEcho;
			$records["recordsTotal"]    = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;
			
			echo json_encode($records);
		}elseif ($args[0] == "concours"){
			if (!isset($args[1])){
				$concours = new concours;
				$concourss = $concours->requete("SELECT COUNT(*) FROM concours");
				$iTotalRecords  = $concourss[0]["COUNT(*)"];
				unset($concourss);
				unset($concours);
				
				$iDisplayLength = intval($_REQUEST['length']);
				$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
				$iDisplayStart  = intval($_REQUEST['start']);
				$sEcho          = intval($_REQUEST['draw']);
				$end = $iDisplayStart + $iDisplayLength;
				$end = $end > $iTotalRecords ? $iTotalRecords : $end;
				$concours = new concours;
				$concourss = $concours->requete("SELECT * FROM concours ORDER BY id DESC LIMIT ".$iDisplayStart.", ".$iDisplayLength."");
				
				
				$records         = array();
			$records["data"] = array();
			
			foreach ($concourss as $key => $value) {
				sscanf($value["start_date"], "%4s-%2s-%2s %2s:%2s:%2s", $anDebut, $moisDebut, $jourDebut, $heureDebut, $minDebut, $secDebut);	
				sscanf($value["end_date"], "%4s-%2s-%2s %2s:%2s:%2s", $anFin, $moisFin, $jourFin, $heureFin, $minFin, $secFin);	
				
				//list($annee, $mois, $jour) = explode("-", $value["birthdate"]);
				$status = ($value["status"] == 1)?"Actif":"Fermé";
				$records["data"][] = array(
			  '<input type="checkbox" name="id[]" value="'.$value["id"].'">',
			  $value["name"],
			  "Le ".$jourDebut."/".$moisDebut."/".$anDebut." à ".$heureDebut.":".$minDebut.":".$secDebut,
			  "Le ".$jourFin."/".$moisFin."/".$anFin." à ".$heureFin.":".$minFin.":".$secFin,
			  $status,
			  "<a href=\"".ADRESSE_SITE."admin/utilisateurs/list_users/".$value["id"]."\" class=\"btn btn-xs default btn-editable\">Voir les utilisateurs</a><br><a href=\"".ADRESSE_SITE."admin/edit/".$value["id"]."\" class=\"btn btn-xs default btn-editable\">Editer le concours</a>"
			  
			  
		   );
				
			}
			
				if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
					$records["customActionStatus"]  = "OK"; // pass custom message(useful for getting status of group actions)
					$records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
				}
				
				$records["draw"]            = $sEcho;
				$records["recordsTotal"]    = $iTotalRecords;
				$records["recordsFiltered"] = $iTotalRecords;
				mail("philgranger@orange.fr", "test", serialize($records));
				echo json_encode($records);
			}else{
				$participant = new participant;
				$participants = $participant->requete("select COUNT(*) from participant, participation where participant.id_participant = participation.id_participant and participation.id_concours = '".intval($args[1])."'");
				$iTotalRecords  = $participants[0]["COUNT(*)"];
				unset($participants);
				unset($participant);
				
				$iDisplayLength = intval($_REQUEST['length']);
				$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
				$iDisplayStart  = intval($_REQUEST['start']);
				$sEcho          = intval($_REQUEST['draw']);
				$end = $iDisplayStart + $iDisplayLength;
				$end = $end > $iTotalRecords ? $iTotalRecords : $end;
				$participant = new participant;
				$participants = $participant->requete("select participant.id, participant.first_name, participant.last_name, participant.birthdate, participant.gender, participation.id_photo, participant.email, participation.updated_at from participant, participation where participant.id_participant = participation.id_participant and participation.id_concours = '".intval($args[1])."' ORDER BY participation.id DESC LIMIT ".$iDisplayStart.", ".$iDisplayLength."");
				$records         = array();
				$records["data"] = array();
			
				$participations = new participation;
				$participations = $participations->requete("SELECT * FROM participation, participant where participation.id_concours = "
				.intval($args[1])." and participation.id_participant = participant.id_participant LIMIT ".$iDisplayStart.", ".$iDisplayLength."");
				
					foreach ($participations as $key => $value){ 
					$response = $this->fb->get($value['id_photo'].'?fields=id,link,picture,source', $_SESSION['facebook_access_token']);
					
					$tab = $response->getDecodedBody();
					
					$rep = $this->fb->get(ADRESSE_SITE."voter/photo/".$value['id_photo'], $_SESSION['facebook_access_token']);
					$tabVote = $rep->getDecodedBody();
					$nbVote = $tabVote['share']['share_count'];

					$ranking[$value['id']] = $nbVote;
					}
				
				
			foreach ($participants as $key => $value) {
			list($annee, $mois, $jour) = explode("-", $value["birthdate"]);
			sscanf($value["updated_at"], "%4s-%2s-%2s %2s:%2s:%2s", $anPart, $moisPart, $jourPart, $heurePart, $minPart, $secPart);	
			
				$genre = ($value["gender"] == 1)?"Homme":"Femme";
				$records["data"][] = array(
			 	'<input type="checkbox" name="id[]" value="'.$value["id"].'">',
			 	$value["first_name"],
			  	$value["last_name"],
				$genre,
				$value["id_photo"],
				$ranking[$value["id"]],
				"Le ".$jourPart."/".$moisPart."/".$anPart." à ".$heurePart.":".$minPart.":".$secPart,
				$jour."/".$mois."/".$annee,
				$value["email"]
		   );
				
			}
			
			if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				$records["customActionStatus"]  = "OK"; // pass custom message(useful for getting status of group actions)
				$records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
			}
			
			$records["draw"]            = $sEcho;
			$records["recordsTotal"]    = $iTotalRecords;
			$records["recordsFiltered"] = $iTotalRecords;
			
			echo json_encode($records);
			}
		}
	}
	
	public function export($args){
		if ($args[0] == "all"){
				$objPHPExcel = new PHPExcel();
					// Set document properties
					$objPHPExcel->getProperties()->setCreator("Concours Photo")
												 ->setLastModifiedBy("Concours Photo")
												 ->setTitle("Concours Photo")
												 ->setSubject("Concours Photo")
												 ->setDescription("Concours Photo")
												 ->setKeywords("Concours Photo")
												 ->setCategory("Concours Photo");
												 
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A1', "Nom")
								->setCellValue('B1', "Prénom")
								->setCellValue('C1', "Genre")
								->setCellValue('D1', "Date de naissance")
								->setCellValue('E1', "Email")
								->setCellValue('F1', "Identifiant photo");
			
			$participant = new participant;
				$participants = $participant->requete("select participant.id, participant.first_name, participant.last_name, participant.birthdate, participant.gender, participation.id_photo, participant.email, participation.updated_at from participant, participation where participant.id_participant = participation.id_participant  ORDER BY participation.id DESC");
				$records         = array();
				$records["data"] = array();
			
				
				
				$j = 2;
			foreach ($participants as $key => $value) {
			list($annee, $mois, $jour) = explode("-", $value["birthdate"]);
			sscanf($value["updated_at"], "%4s-%2s-%2s %2s:%2s:%2s", $anPart, $moisPart, $jourPart, $heurePart, $minPart, $secPart);	
				$genre = ($value["gender"] == 1)?"Homme":"Femme";
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$j.'', $value["first_name"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$j.'', $value["last_name"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$j.'', $genre);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$j.'', $jour."/".$mois."/".$annee);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$j.'', $value["email"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$j.'', $value["id_photo"]);
				$j++;				
			}
			
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Export');
			
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			
			
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="bordereauderemiseprefecture.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			
			
			
		}elseif (is_numeric($args[0])){
			
			$objPHPExcel = new PHPExcel();
					// Set document properties
					$objPHPExcel->getProperties()->setCreator("Concours Photo")
												 ->setLastModifiedBy("Concours Photo")
												 ->setTitle("Concours Photo")
												 ->setSubject("Concours Photo")
												 ->setDescription("Concours Photo")
												 ->setKeywords("Concours Photo")
												 ->setCategory("Concours Photo");
												 
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A1', "Nom")
								->setCellValue('B1', "Prénom")
								->setCellValue('C1', "Genre")
								->setCellValue('D1', "Date de naissance")
								->setCellValue('E1', "Email")
								->setCellValue('F1', "Identifiant photo")
								->setCellValue('G1', "Nombre de votes");
			
			$participant = new participant;
				$participants = $participant->requete("select participant.id, participant.first_name, participant.last_name, participant.birthdate, participant.gender, participation.id_photo, participant.email, participation.updated_at from participant, participation where participant.id_participant = participation.id_participant and participation.id_concours = '".intval($args[0])."'  ORDER BY participation.id DESC");
				$records         = array();
				$records["data"] = array();
			
				$participations = new participation;
				$participations = $participations->requete("SELECT * FROM participation, participant where participation.id_concours = "
				.intval($args[0])." and participation.id_participant = participant.id_participant");
				
					foreach ($participations as $key => $value){ 
					$response = $this->fb->get($value['id_photo'].'?fields=id,link,picture,source', $_SESSION['facebook_access_token']);
					
					$tab = $response->getDecodedBody();
					
					$rep = $this->fb->get(ADRESSE_SITE."voter/photo/".$value['id_photo'], $_SESSION['facebook_access_token']);
					$tabVote = $rep->getDecodedBody();
					$nbVote = $tabVote['share']['share_count'];

					$ranking[$value['id']] = $nbVote;
					}
				
				$j = 2;
			foreach ($participants as $key => $value) {
			list($annee, $mois, $jour) = explode("-", $value["birthdate"]);
			sscanf($value["updated_at"], "%4s-%2s-%2s %2s:%2s:%2s", $anPart, $moisPart, $jourPart, $heurePart, $minPart, $secPart);	
				$genre = ($value["gender"] == 1)?"Homme":"Femme";
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$j.'', $value["first_name"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$j.'', $value["last_name"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$j.'', $genre);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$j.'', $jour."/".$mois."/".$annee);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$j.'', $value["email"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$j.'', $value["id_photo"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$j.'', $ranking[$value["id"]]);
				$j++;				
			}
			
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Export');
			
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			
			
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="bordereauderemiseprefecture.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
		}
	}
	
	
	
}