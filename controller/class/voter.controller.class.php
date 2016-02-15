<?php
class voter {
	private $loginUrl;
	private $fb;
	private $open = FALSE;
	
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
			$scope =["email","user_likes","user_photos","publish_actions"];

			$this->loginUrl = $helper->getLoginUrl(ADRESSE_SITE.'callback/',$scope);
		}else{
			$this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		}
		
		$leConcours = new concours;
		// On sélectionne le concours ouvert
		$leConcours->getOneBy("1", "status", "concours");
		$leConcours->setFromBdd($leConcours->result);

		if($leConcours->getId() != ""){
			$this->open = TRUE;
		}else{
			$this->open = FALSE;
			header("Location: ".ADRESSE_SITE);
			exit();
		}
		
	}

	public function defaultPage($args) {
		if(!isset($_SESSION['facebook_access_token'])){
			header('location:'. $this->loginUrl);
		}

		$page = 1;
		$current = 1;

		$leConcours = new concours;
		// On sélectionne le concours ouvert
		$leConcours->getOneBy("1", "status", "concours");
		$leConcours->setFromBdd($leConcours->result);

		if($leConcours->getId() != "")
		{
			$countParticipation = new participation;
			$countParticipation = $countParticipation->requete("SELECT count(*) as nb FROM participation, participant where participation.id_concours = "
				.$leConcours->getId()." and participation.id_participant = participant.id_participant");

			if(isset($countParticipation[0]))
			{
				
				$maxParPage = ($leConcours->getMax_per_page() != "" && $leConcours->getMax_per_page > 0)?$leConcours->getMax_per_page:8;

				$nbPages = ceil($countParticipation[0]['nb']/$maxParPage);
				if(!empty($args))
				{
					if(is_numeric($args[0]))
					{
						$page = intval($args[0]);
						if ($page >= 1 && $page <= $nbPages) {
					    $current = $page;
						} else if ($page < 1) {
							// cas où le numéro de page est inférieure 1 : on affecte 1 à la page courante
							$current=1;
						} else {
							//cas où le numéro de page est supérieur au nombre total de pages : on affecte le numéro de la dernière page à la page courante
							$current = $nbPages;
						}
					}
				}
				
				$idMin = ($page - 1) * $maxParPage;

				$participations = new participation;
				$participations = $participations->requete("SELECT * FROM participation, participant where participation.id_concours = "
				.$leConcours->getId()." and participation.id_participant = participant.id_participant LIMIT ".$idMin.", ".$maxParPage);
				
			}
			
		}
		else // Pas de concours ouvert
		{
			$_SESSION['flash_messageError'] = "Le Concours n'est pas encore ouvert";
			header('Location: '.ADRESSE_SITE.'index/defaultPage/');
		}
		
		$maParticipation = new participation;
		// retrouve la participation du user connecter
		$maParticipation->getOneByAnd($_SESSION['idParticipant'],$leConcours->getId(), 'id_participant', 'id_concours', 'participation');
		$maParticipation->setFromBdd($maParticipation->result);

		$view = new view("front", "voter");
		$view->assign('loginUrl',$this->loginUrl);
		$view->assign('leConcours',$leConcours);
		$view->assign('participations',$participations);
		$view->assign('maParticipation',$maParticipation);
		$view->assign('fb',$this->fb);
		//pour la pagination
		$view->assign('nbPages',$nbPages);
		$view->assign('current',$current);

	}

	public function voterAction($args) {
		die("ok");
		$view = new view("front", "voter");
	}


	public function photo($args)
	{
		if(empty($args)){
			header('Location: '.ADRESSE_SITE);
			exit();
		}

		if(is_numeric($args[0]))
		{
			try {
				$response = $this->fb->get($args[0].'?fields=id,link,picture,source', $_SESSION['facebook_access_token']);
				$tab = $response->getDecodedBody(); 
				
			} catch (Exception $e) {
				header('Location: '.ADRESSE_SITE);
				exit();
			}
		}
		else{
			header('Location: '.ADRESSE_SITE);
			exit();
		}

		$view = new view("front", "photo");

		$view->assign("tab", $tab);

	}

}
