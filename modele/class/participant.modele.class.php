<?php
class participant extends bdd{
	
	protected $id;
	protected $nom;
	protected $prenom;
	protected $email;
	protected $sexe;
	protected $date_naissance;
	protected $ville;
	protected $role;
	
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

	
	public function set_id($id){
		$this->id = $id;
	}
	
	public function set_nom($nom){
		$this->nom = $nom;
	}
	
	public function set_prenom($prenom){
		$this->prenom = $prenom;
	}
	
	public function set_email($email){
		$this->email = $email;
	}
	
	public function set_sexe($sexe){
		$this->sexe = $sexe;
	}
	
	public function set_date_naissance($date_naissance){
		$this->date_naissance = $date_naissance;
	}
	
	public function set_ville($ville){
		$this->ville = $ville;
	}

	public function set_role($role){
		$this->role = $role;
	}
	
	public function get_id(){
		return $this->id;
	}
	
	public function get_nom(){
		return $this->nom;
	}
	
	public function get_prenom(){
		return $this->prenom;
	}
	
	public function get_email(){
		return $this->email;
	}
	
	public function get_sexe(){
		return $this->sexe;
	}
	
	public function get_date_naissance(){
		return $this->date_naissance;
	}
	
	public function get_ville(){
		return $this->ville;
	}

	public function get_role(){
		return $this->role;
	}

}
?>