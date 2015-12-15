<?php
class participation extends bdd{
	
	protected $idConcours;
	protected $idParticipant;
	protected $idPhoto;
    protected $createdAt;
    protected $updatedAt;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function setFromBdd($var = []){
		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
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
        return $this->idConcours;
    }

    /**
     * Sets the value of idConcours.
     *
     * @param mixed $idConcours the id concours
     *
     * @return self
     */
    public function setIdConcours($idConcours)
    {
        $this->idConcours = $idConcours;

        return $this;
    }

    /**
     * Gets the value of idParticipant.
     *
     * @return mixed
     */
    public function getIdParticipant()
    {
        return $this->idParticipant;
    }

    /**
     * Sets the value of idParticipant.
     *
     * @param mixed $idParticipant the id participant
     *
     * @return self
     */
    public function setIdParticipant($idParticipant)
    {
        $this->idParticipant = $idParticipant;

        return $this;
    }

    /**
     * Gets the value of idPhoto.
     *
     * @return mixed
     */
    public function getIdPhoto()
    {
        return $this->idPhoto;
    }

    /**
     * Sets the value of idPhoto.
     *
     * @param mixed $idPhoto the id photo
     *
     * @return self
     */
    public function setIdPhoto($idPhoto)
    {
        $this->idPhoto = $idPhoto;

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param mixed $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Gets the value of updatedAt.
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Sets the value of updatedAt.
     *
     * @param mixed $updatedAt the updated at
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
?>