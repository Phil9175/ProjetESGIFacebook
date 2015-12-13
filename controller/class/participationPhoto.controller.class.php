<?php

class photo{
    private $loginUrl;
    private $fb;

    public function __construct(){
        $this->fb = new Facebook\Facebook([
            'app_id' => APP_ID,
            'app_secret' =>APP_SECRET,
            'default_graph_version' => 'v2.5',
        ]);
        if(!isset($_SESSION['facebook_access_token'])){
            $helper = $this->fb->getRedirectLoginHelper();
            $scope =["email","user_likes","user_photos","publish_actions"];

            $this->loginUrl = $helper->getLoginUrl('http://concoursphotosesgi.localhost/login-callback.php',$scope);
            var_dump($this->loginUrl);
        }else{
            $this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        }
    }

    public function index(){
        die('ok');
        $response = $this->fb->get('/me/albums?fields=name,photos{picture}');
        $userNode = $response->getDecodedBody();

        $view = new view("front","participation");
        $view->assign('userNode',$userNode);
    }
}