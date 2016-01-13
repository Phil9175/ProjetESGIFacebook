<?php

class participationPhoto{
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
            $scope =["email","user_likes","user_photos","publish_actions","user_birthday","user_location"];

            $this->loginUrl = $helper->getLoginUrl('http://concoursphotosesgi.localhost/login-callback.php',$scope);
        }else{
            $this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        }
    }

    public function index(){
        $response = $this->fb->get('/me/albums?fields=name,photos{picture}');
        $userNode = $response->getDecodedBody();

        $view = new view("front","participation");
        $view->assign('userNode',$userNode);
    }

    public function photo($idAlbum){
        $response = $this->fb->get('/me/albums?fields=name,photos{picture}');
        $userNode = $response->getDecodedBody();
        $view = new view("front","photoSelection");

        foreach ($userNode['data'] as $album) {
            if($album['id'] === $idAlbum[0]){
                $view->assign('album',$album);
            }
        }
    }

    public function sendPhoto($idPhoto){
        $participation = new participation();
        $concours = new concours();

        $concours->getOneBy("1","status","concours");
        $concours->setFromBdd($concours->result);

        $idParticipant = $this->sendParticipant();

        $participation->setIdPhoto($idPhoto[0]);

        $participation->getOneBy($idPhoto[0],"id_photo","participation");
        $participation->setFromBdd($participation->result);

        var_dump($participation);

        if($participation->getIdPhoto()){
            $_SESSION['flash_messageError'] = "La photo a déjà été enregistré.";
            header('Location: /index/defaultPage/');
        }

        $participation->setIdParticipant($idParticipant);
        $participation->setIdConcours($concours->getId());
        $participation->setCreatedAt(date("Y-m-d H:i:s"));
        $participation->setUpdatedAt(date("Y-m-d H:i:s"));
        try{

            $participation->save("participation");

            $_SESSION['flash_messageValidate'] = "La photo a bien été enregistré.";
            header('Location: /index/defaultPage/');

        }catch (Exception $e){
            var_dump($e);
        }
    }

    public function sendParticipant(){
        $response = $this->fb->get('/me?fields=id,email,birthday,gender,first_name,last_name');
        $userNode = $response->getDecodedBody();
        $participant = new participant();

        $participant->getOneBy($userNode['id'],"id_participant","participant");
        $participant->setFromBdd($participant->result);
        $id = $participant->getIdParticipant();

        if (!$id) {
            $participant->setIdParticipant(trim($userNode['id']));

            $participant->setLastName($userNode['last_name']);
            $participant->setFirstName($userNode['first_name']);
            $participant->setName($userNode['first_name']." ". $userNode['last_name']);
            if($userNode['gender'] == 'male'){
                $participant->setGender(1);
            }else{
                $participant->setGender(0);
            }
            $participant->setEmail($userNode['email']);
            $participant->setBirthDate($userNode['birthday']);
            $participant->setRole("participant");

            $participant->save("participant");

            return trim($userNode['id']);
        }

        return $userNode['id'];
    }
}