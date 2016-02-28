<?php
class cron {
	public function __construct() {
	}
	
	public function defaultPage($args) {
		$leConcours = new concours;
		// On sélectionne le concours ouvert
		$leConcours->getOneBy(1, "status", "concours");
		$leConcours->setFromBdd($leConcours->result);
			sscanf($leConcours->getStartDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
			$date_debut = $an.$mois.$jour.$heure.$min.$sec;
			sscanf($leConcours->getEndDate(), "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);			
			$date_fin = $an.$mois.$jour.$heure.$min.$sec;
			$date = date("YmdHis");
			
			if ($date > $date_fin && $leConcours->getIs_notify() == 0){
				$participant = new participant;
				$participants = $participant->requete("select participant.id, participant.first_name, participant.last_name, participant.birthdate, participant.gender, participation.id_photo, participant.email, participation.updated_at from participant, participation where participant.id_participant = participation.id_participant and participation.id_concours = '".intval($leConcours->getId())."'");
			
				$app_id = APP_ID;
				$app_secret = APP_SECRET;
				$app_access_token = $app_id . '|' . $app_secret;
		
				$fb = new Facebook\Facebook([
							'app_id' => APP_ID,
							'app_secret' =>APP_SECRET,
							'default_graph_version' => 'v2.5',
				]);
				
				foreach ($participants as $key => $value) {
					$response = $fb->post('/'.$value["id_participant"].'/notifications', [
						'template' => "Le concours Photos ESGI est terminé, connectez-vous pour voir votre score!",
						'href' => "concoursphotosesgi.com/index",
						'access_token' => $app_access_token
					]);
				}
				
				$leConcours->setIs_notify(1);
				$leConcours->save("concours");
			}
			
	}
}