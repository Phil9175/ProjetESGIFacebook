<?php
class index {
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

			$this->loginUrl = $helper->getLoginUrl('https://www.concoursphotosesgi.com/login-callback.php',$scope);
		}else{

			$this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

			if(!isset($_SESSION['idParticipant']))
			{
				$response = $this->fb->get('/me', $_SESSION['facebook_access_token']);
				$idParticipant = $response->getDecodedBody()['id'];
				
				$_SESSION['idParticipant'] = $idParticipant;
			}
		}

	}

	public function defaultPage($args) {
		if(!isset($_SESSION['facebook_access_token'])){
			header('location:'. $this->loginUrl);
		}
		
		
		
		$participant = new participant();
		$participant->getOneBy($_SESSION['idParticipant'], "id", "participant");
		$participant->setFromBdd($participant->result);
		
		
		$view = new view("front","accueil");
		$view->assign('loginUrl', $this->loginUrl);
		$view->assign('status', $participant->getRole());
	}
	
	public function participerAction($args) {

		$view = new view("front","participation");
	}

	public function not_logged($args){
		$fb = new Facebook\Facebook([
		  'app_id' => APP_ID,
		  'app_secret' => APP_SECRET,
		  'default_graph_version' => 'v2.5',
		  ]);
  
		  if(!isset($_SESSION['facebook_access_token']))
		  {
			  $helper = $fb->getRedirectLoginHelper();
			  $scope = ['email','user_likes','user_photos'];
			  $loginUrl = $helper->getLoginUrl('http://projetesgifacebook.com/login-callback.php', $scope);
			  $view = new view("index", "index");
			  $view->assign("link", $loginUrl);
		  }else{
			  header('Location: index/logged/');
			  exit();
		  }
  	}
	
	public function fb_callback($args){
		$fb = new Facebook\Facebook([
		  'app_id' => APP_ID,
		  'app_secret' => APP_SECRET,
	  'default_graph_version' => 'v2.5',
	  ]);
	  
	  $helper = $fb->getRedirectLoginHelper();
	  
	  try {
	  	$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		
		if (isset($accessToken)) {
		  $_SESSION['facebook_access_token'] = (string) $accessToken;	
		  header('Location: /index/logged');  
		}else{
			
		}
	}
	
	public function logged($args){
		$fb = new Facebook\Facebook([
		  'app_id' => APP_ID,
		  'app_secret' => APP_SECRET,
		  'default_graph_version' => 'v2.5',
		  ]);
  	
	  	if(!isset($_SESSION['facebook_access_token'])){
			header('Location: index/not_logged');
			exit();
		}else{

		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  
		$session = new Facebook\FacebookApp(APP_ID, APP_SECRET);
        $request = new Facebook\FacebookRequest($session, $_SESSION['facebook_access_token'], 'GET', 'me/albums?fields=name,photos.fields(name,picture)');
        $response = $fb->getClient()->sendRequest($request);
        $body= $response->getBody();
        $tab = json_decode($body);
       
        foreach ($tab->{'data'} as $oneAlbum) {
            echo "<h2>".$oneAlbum->{'name'}."</h2>";
            $myPhotos = $oneAlbum->{'photos'}->{'data'};
            foreach ($myPhotos as $onePhoto) {
                    ?>

                    <img src="<?php echo $onePhoto->{'picture'} ?>">

                    <?php
            }
            echo "<br>";
            echo "<hr>";
        }
	}
	}
	
	
}