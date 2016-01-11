<?php 
	session_start();
	date_default_timezone_set("Europe/Paris");
	require_once 'controller/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';
	
	$fb = new Facebook\Facebook([
	  'app_id' => '1512282232403521',
	  'app_secret' => '2be2ccc29cb5bfa1db27450452f7a71f',
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
		header("location:/");
	}