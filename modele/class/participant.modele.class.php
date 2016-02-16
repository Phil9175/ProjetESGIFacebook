<?php
class participant extends bdd{

    protected $id;
    protected $id_participant;
	protected $first_name;
    protected $last_name;
	protected $email;
	protected $gender;
	protected $birthDate;
	protected $city;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function setFromBdd($var = []){
		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}
	
	public function save($table = "participant"){
		parent::save($table);
	}

	public function setId($id){
		$this->id = $id;
	}
	
	public function getId(){
		return $this->id;
	}
	
    /**
     * Sets the value of id FB.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setIdParticipant($id_participant)
    {
        $this->id_participant = $id_participant;

        return $this;
    }

    /**
     * Gets the value of id FB.
     *
     * @return mixed
     */
    public function getIdParticipant()
    {
        return $this->id_participant;
    }
    /**
     * Gets the value of firstName.
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Sets the value of firstName.
     *
     * @param mixed $firstName the firstName
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of gender.
     *
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Sets the value of gender.
     *
     * @param mixed $gender the gender
     *
     * @return self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Gets the value of birthDate.
     *
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Sets the value of birthDate.
     *
     * @param mixed $birthDate the birth date
     *
     * @return self
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Gets the value of city.
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the value of city.
     *
     * @param mixed $city the city
     *
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

   
    /**
     * Gets the value of lastName.
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Sets the value of lastName.
     *
     * @param mixed $lastName the lastName
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }
}
?>