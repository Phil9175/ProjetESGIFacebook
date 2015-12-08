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
		$view = new view("front","voter");
		$view->assign('loginUrl',$this->loginUrl);
	}

	public function voterAction($args) {

		$view = new view("front","voter");
	}

}