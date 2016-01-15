<?php
class voter {
	private $loginUrl;
	private $fb;
	public function __construct() {
		//session_destroy();
		//die('okj');
		$this->fb = new Facebook\Facebook([
				'app_id' => APP_ID,
				'app_secret' =>APP_SECRET,
				'default_graph_version' => 'v2.5',
		]);
		if(!isset($_SESSION['facebook_access_token'])){
			$helper = $this->fb->getRedirectLoginHelper();
			$scope =["email","user_likes","user_photos","publish_actions"];

			$this->loginUrl = $helper->getLoginUrl('http://concoursphotosesgi.localhost/login-callback.php',$scope);
		}else{
			$this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			
		}
	}

	public function defaultPage($args) {
		if(!isset($_SESSION['facebook_access_token'])){
			header('location:'. $this->loginUrl);
		}
		$leConcours = new concours;
		// On sélectionne le concours ouvert
		$leConcours->getOneBy("1", "status", "concours");
		$leConcours->setFromBdd($leConcours->result);

		try {
			$participation = new participation;
			// On sélectionne les participations du concours ci dessus
			$participations = $participation->requete("SELECT * FROM participation, participant where participation.id_concours = "
				.$leConcours->getId()." and participation.id_participant = participant.id_participant");
			
		} catch (Exception $e) {
			$_SESSION['flash_messageError'] = "Le Concours n'est pas encore ouvert";
			header('Location: /index/defaultPage/');
		}
		
		$maParticipation = new participation;
		// retrouve la participation du user connecter
		$maParticipation->getOneByAnd($_SESSION['idParticipant'],$leConcours->getId(), 'id_participant', 'id_concours', 'participation');
		$maParticipation->setFromBdd($maParticipation->result);

		$view = new view("front","voter");
		$view->assign('loginUrl',$this->loginUrl);
		$view->assign('leConcours',$leConcours);
		$view->assign('participations',$participations);
		$view->assign('maParticipation',$maParticipation);
		$view->assign('fb',$this->fb);
	}

	public function voterAction($args) {

		$view = new view("front","voter");
	}

}