<?php
class concours extends bdd{
	
	protected $id;
	protected $titre;
	protected $description;
	protected $date_debut;
	protected $date_fin;
	protected $classement;
	protected $prix;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function setFromBdd($var = []){
		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}
	
	public function save(){
		$this->classement = serialize($this->classement);
		parent::save("concours");
	}

	
	public function set_id($id){
		$this->id = $id;
	}
	
	public function set_titre($titre){
		$this->titre = $titre;
	}
	
	public function set_description($description){
		$this->description = $description;
	}
	
	public function set_date_debut($date_debut){
		$this->date_debut = $date_debut;
	}
	
	public function set_date_fin($date_fin){
		$this->date_fin = $date_fin;
	}
	
	public function set_classement($classement){
		$this->classement = $classement;
	}
	
	public function set_prix($prix){
		$this->prix = $prix;
	}
	
	public function get_id($id){
		return $this->id;
	}
	
	public function get_titre($titre){
		return $this->titre;
	}
	
	public function get_description($description){
		return $this->description;
	}
	
	public function get_date_debut($date_debut){
		return $this->date_debut;
	}
	
	public function get_date_fin($date_fin){
		return $this->date_fin;
	}
	
	public function get_classement($classement){
		return $this->classement;
	}
	
	public function get_prix($prix){
		return $this->prix;
	}
}
?>