<?php

class participationPhoto{
    private $loginUrl;
    private $fb;
    private $user;

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
        $response = $this->fb->get('/me?fields=id,email,birthday,gender,first_name,last_name');
        $this->user = $response->getDecodedBody();
    }

    public function index(){
        $response = $this->fb->get('/me/albums?fields=name,photos{picture}');
        $userNode = $response->getDecodedBody();

        $idPhoto = $this->isParticipate($this->user['id']);
        $view = new view("front","participation");
        $view->assign('userNode',$userNode);

        foreach($userNode['data'] as $album){
            if(isset($album['photos'])){
                $size = count($album['photos']['data']);
                for($i =0; $i < $size; $i++){
                       if($album['photos']['data'][$i]['id'] == $idPhoto){
                           $myphoto = $album['photos']['data'][$i]['picture'];
                           $view->assign('myPhoto',$myphoto);
                       }
                }
            }
        }
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

    public function isParticipate($idParticipant){
        $participation = new participation();

        $participation->getOneBy($idParticipant,"id_participant","participation");

        $participation->setFromBdd($participation->result);

        if($participation->getIdPhoto() == null){
            return false;
        }else{
            return $participation->getIdPhoto();
        }
    }

    public function importPhoto(){
        if ($_FILES['fichier']['error']) {
            switch ($_FILES['fichier']['error']) {
                case 1: // UPLOAD_ERR_INI_SIZE
                    $_SESSION['flash_messageError'] = "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                    header('Location: /index/defaultPage/');
                    break;
                case 2: // UPLOAD_ERR_FORM_SIZE
                    $_SESSION['flash_messageError'] = "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                    header('Location: /index/defaultPage/');
                    break;
                case 3: // UPLOAD_ERR_PARTIAL
                    $_SESSION['flash_messageError'] = "L'envoi du fichier a été interrompu pendant le transfert !";
                    header('Location: /index/defaultPage/');
                    break;
                case 4: // UPLOAD_ERR_NO_FILE
                    $_SESSION['flash_messageError'] = "Le fichier que vous avez envoyé a une taille nulle !";
                    header('Location: /index/defaultPage/');
                    break;
            }
        }else{
            $data = [
                'message' => 'Ceci est ma photo pour participer au concours photo ESGI',
                'source' => $this->fb->fileToUpload($_FILES['fichier']['tmp_name']),
            ];

            try {
                $response = $this->fb->post('/photos', $data);

                $idPhoto = array();
                $idPhoto[0] = $response->getDecodedBody()['id'];

                $this->sendPhotoFB($idPhoto);

            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Error: ' . $e->getMessage();
                exit;
            }
        }
    }
    public function sendPhotoFB($idPhoto){
        $participation = new participation();
        $concours = new concours();

        $concours->getOneBy("1","status","concours");
        $concours->setFromBdd($concours->result);

        $idParticipant = $this->sendParticipant();

        $participation->getOneBy($idParticipant,"id_participant","participation");
        $participation->setFromBdd($participation->result);



        if($participation->getIdPhoto() == $idPhoto[0]){
            $_SESSION['flash_messageError'] = "La photo a déjà été enregistré.";
            header('Location: /index/defaultPage/');
        }else if($participation->getIdPhoto() != null){
            $participation->requeteDelete("DELETE FROM participation WHERE id_photo = ".$participation->getIdPhoto());
            $participation= new participation();
        }



        $participation->setIdPhoto($idPhoto[0]);

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
        $participant = new participant();

        $participant->getOneBy($this->user['id'],"id_participant","participant");
        $participant->setFromBdd($participant->result);
        $id = $participant->getIdParticipant();

        if (!$id) {
            $id = trim($this->user['id']);
            $participant->setIdParticipant($id);

            $participant->setLastName($this->user['last_name']);
            $participant->setFirstName($this->user['first_name']);
            $participant->setName($this->user['first_name']." ". $this->user['last_name']);
            if($this->user['gender'] == 'male'){
                $participant->setGender(1);
            }else{
                $participant->setGender(0);
            }
            $participant->setEmail($this->user['email']);
            $participant->setBirthDate($this->user['birthday']);
            $participant->setRole("participant");

            $participant->save("participant");
        }

        return $id;
    }

    public function deleteParticipation(){
        $participation = new participation();
        $participation->requeteDelete(("DELETE FROM participation WHERE id_participant = ".$this->user['id']));

        $_SESSION['flash_messageValidate'] = "Votre participation a bien été annulée.";
        header('Location: /index/defaultPage/');
    }
}