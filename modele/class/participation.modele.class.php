<?php
class participation extends bdd{

    protected $id;
	protected $id_concours;
	protected $id_participant;
	protected $id_photo;
    protected $created_at;
    protected $updated_at;
	
	public function __construct(){
		parent::__construct();
	}

	/*public function setFromBdd($var = []){

		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}
*/
    public function setFromBdd($var = []){
        $participation = $this;

        foreach ($var as $propertyToSet => $value) {

            switch ($propertyToSet) {
                case 'id':
                    $participation->setId($value);
                    break;
                case 'id_concours':
                    $participation->setIdConcours($value);
                    break;
                case 'id_participant':
                    $participation->setIdParticipant($value);
                    break;
                case 'id_photo':
                    $participation->setIdPhoto($value);
                    break;
                case 'created_at':
                    $participation->setCreatedAt($value);
                    break;
                case 'updated_at':
                    $participation->setUpdatedAt($value);
                    break;
            }
           
            // $participation->set{fonctions::camelCase($propertyToSet)} = $value;
        }
    }
	public function save($table = "participation"){
		parent::save($table);
	}

     /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getid()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id concours
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Gets the value of idConcours.
     *
     * @return mixed
     */
    public function getIdConcours()
    {
        return $this->id_concours;
    }

    /**
     * Sets the value of idConcours.
     *
     * @param mixed $idConcours the id concours
     *
     * @return self
     */
    public function setIdConcours($id_concours)
    {
        $this->id_concours = $id_concours;

        return $this;
    }

    /**
     * Gets the value of idParticipant.
     *
     * @return mixed
     */
    public function getIdParticipant()
    {
        return $this->id_participant;
    }

    /**
     * Sets the value of idParticipant.
     *
     * @param mixed $idParticipant the id participant
     *
     * @return self
     */
    public function setIdParticipant($id_participant)
    {
        $this->id_participant = $id_participant;

        return $this;
    }

    /**
     * Gets the value of idPhoto.
     *
     * @return mixed
     */
    public function getIdPhoto()
    {
        return $this->id_photo;
    }

    /**
     * Sets the value of idPhoto.
     *
     * @param mixed $idPhoto the id photo
     *
     * @return self
     */
    public function setIdPhoto($id_photo)
    {
        $this->id_photo = $id_photo;

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param mixed $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Gets the value of updatedAt.
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return new DateTime($this->updated_at);
    }

    /**
     * Sets the value of updatedAt.
     *
     * @param mixed $updatedAt the updated at
     *
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return String chemin de la photo
     **/
    public function getPhotoPath(){

        return "/view/uploads/concours_photos/".$this->id_photo_name;
    }
}
?>