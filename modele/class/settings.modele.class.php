<?php
class settings extends bdd{

    protected $id;
	protected $logo_societe;
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
	
	public function set_logo_societe($logo_societe){
		$this->logo_societe = $logo_societe;
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
		return $this->id;
	}
	
	public function get_logo_societe(){
		return $this->logo_societe;
	}
	
	public function get_nom_societe(){
		return $this->nom_societe;
	}
	
	public function get_mail_host(){
		return $this->mail_host;
	}
	
	public function get_mail_port(){
		return $this->mail_port;
	}
	
	public function get_mail_username(){
		return $this->mail_username;
	}
	
	public function get_mail_password(){
		return $this->mail_password;
	}
}
?>