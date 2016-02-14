<?php
class settings extends bdd{

    protected $id;
	protected $logo_concours;
	protected $nom_societe;
	protected $mail_host;
    protected $mail_port;
    protected $mail_username;
    protected $mail_password;
	
	public function __construct(){
		parent::__construct();
	}

	public function setFromBdd($var = []){

		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}
    
	public function save($table = "settings"){
		parent::save($table);
	}
	
	public function set_id($id){
		$this->id = $id;
	}
	
	public function set_logo_concours($concours){
		$this->concours = $concours;
	}
	
	public function set_nom_societe($nom_societe){
		$this->nom_societe = $nom_societe;
	}
	
	public function set_mail_host($mail_host){
		$this->mail_host = $mail_host;
	}
	
	public function set_mail_port($mail_port){
		$this->mail_port = $mail_port;
	}
	
	public function set_mail_username($mail_username){
		$this->mail_username = $mail_username;
	}
	
	public function set_mail_password($mail_password){
		$this->mail_password = $mail_password;
	}
		
		
	public function get_id(){
		$this->id;
	}
	
	public function get_logo_concours(){
		$this->concours;
	}
	
	public function get_nom_societe(){
		$this->nom_societe;
	}
	
	public function get_mail_host(){
		$this->mail_host;
	}
	
	public function get_mail_port(){
		$this->mail_port;
	}
	
	public function get_mail_username(){
		$this->mail_username;
	}
	
	public function get_mail_password(){
		$this->mail_password;
	}
}
?>