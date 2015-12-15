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
			$participations = $participation->getResults("", "", "participation", "WHERE id_concours = ".$leConcours->getId()." ORDER BY updated_at");
			
		} catch (Exception $e) {
			// echo "LOL";
			header('Location: /index/defaultPage/');
		}

		$view = new view("front","voter");
		$view->assign('loginUrl',$this->loginUrl);
		$view->assign('leConcours',$leConcours);
		$view->assign('participations',$participations);
		$view->assign('fb',$this->fb);

	}

	public function voterAction($args) {

		$view = new view("front","voter");
	}

}