<?php
class participation extends bdd{
	
	protected $idConcours;
	protected $idParticipant;
	protected $prenom;
	protected $email;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function setFromBdd($var = []){
		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}
	
	public function save(){
		parent::save("participant");
	}

	public function set_idConcours($idConcours){
		$this->idConcours = $idConcours;
	}
	
	public function set_idParticipant($idParticipant){
		$this->idParticipant = $idParticipant;
	}
	
	public function set_idPhoto($idPhoto){
		$this->idPhoto = $idPhoto;
	}
	
	public function get_idConcours(){
		return $this->idConcours;
	}
	
	public function get_idParticipant(){
		return $this->idParticipant;
	}
	
	public function get_idPhoto(){
		return $this->idPhoto;
	}
}
?>