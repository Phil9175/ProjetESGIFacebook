<?php
class participation extends bdd{

    protected $id;
	protected $id_Concours;
	protected $id_Participant;
	protected $id_Photo;
    protected $created_At;
    protected $updated_At;
	
	public function __construct(){
		parent::__construct();
	}

/*	public function setFromBdd($var = []){
        var_dump($var);

		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}*/

    public function setFromBdd($var = []){
        $participation = $this;

        foreach ($var as $propertyToSet => $value) {
            $participation->{fonctions::camelCase($propertyToSet)} = $value;
        }
    }
	public function save($table = "participation"){
		parent::save($table);
	}

    /**
     * Gets the value of idConcours.
     *
     * @return mixed
     */
    public function getIdConcours()
    {
        return $this->id_Concours;
    }

    /**
     * Sets the value of idConcours.
     *
     * @param mixed $idConcours the id concours
     *
     * @return self
     */
    public function setIdConcours($id_Concours)
    {
        $this->id_Concours = $id_Concours;

        return $this;
    }

    /**
     * Gets the value of idParticipant.
     *
     * @return mixed
     */
    public function getIdParticipant()
    {
        return $this->id_Participant;
    }

    /**
     * Sets the value of idParticipant.
     *
     * @param mixed $idParticipant the id participant
     *
     * @return self
     */
    public function setIdParticipant($id_Participant)
    {
        $this->id_Participant = $id_Participant;

        return $this;
    }

    /**
     * Gets the value of idPhoto.
     *
     * @return mixed
     */
    public function getIdPhoto()
    {
        return $this->id_Photo;
    }

    /**
     * Sets the value of idPhoto.
     *
     * @param mixed $idPhoto the id photo
     *
     * @return self
     */
    public function setIdPhoto($id_Photo)
    {
        $this->id_Photo = $id_Photo;

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_At;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param mixed $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt($created_At)
    {
        $this->created_At = $created_At;

        return $this;
    }

    /**
     * Gets the value of updatedAt.
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return new DateTime($this->updated_At);
    }

    /**
     * Sets the value of updatedAt.
     *
     * @param mixed $updatedAt the updated at
     *
     * @return self
     */
    public function setUpdatedAt($updated_At)
    {
        $this->updated_At = $updated_At;

        return $this;
    }

    /**
     * @return String chemin de la photo
     **/
    public function getPhotoPath(){

        return "/view/uploads/concours_photos/".$this->idPhoto.".jpg";
    }
}
?>