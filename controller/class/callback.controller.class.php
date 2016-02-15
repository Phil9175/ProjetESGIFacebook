<?php
class callback {
	public function __construct() {
		$fb = new Facebook\Facebook([
		  'app_id' => APP_ID,
		  'app_secret' => APP_SECRET,
		  'default_graph_version' => 'v2.5',
		  ]);
		$helper = $fb->getRedirectLoginHelper();
		
		try{
		$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		
		if(isset($accessToken)){
			$_SESSION['facebook_access_token'] = (string) $accessToken;
			header("Location: ".ADRESSE_SITE);
		}
	}
	
	public function defaultPage(){
	}
}
