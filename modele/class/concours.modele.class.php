<?php
class concours extends bdd{
	
	protected $id;
	protected $name;
	protected $description;
	protected $startDate;
	protected $endDate;
	protected $ranking;
	protected $award;
	protected $status;
    protected $logo;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function setFromBdd($var = []){
		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}
	
	public function save(){
		$this->ranking = serialize($this->ranking);
		parent::save("concours");
	}

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of startDate.
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the value of startDate.
     *
     * @param mixed $startDate the start date
     *
     * @return self
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Gets the value of endDate.
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Sets the value of endDate.
     *
     * @param mixed $endDate the end date
     *
     * @return self
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Gets the value of ranking.
     *
     * @return mixed
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * Sets the value of ranking.
     *
     * @param mixed $ranking the ranking
     *
     * @return self
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * Gets the value of award.
     *
     * @return mixed
     */
    public function getAward()
    {
        return $this->award;
    }

    /**
     * Sets the value of award.
     *
     * @param mixed $award the award
     *
     * @return self
     */
    public function setAward($award)
    {
        $this->award = $award;

        return $this;
    }

    /**
     * Gets the value of status.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the value of status.
     *
     * @param mixed $status the status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Gets the value of logo.
     *
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the value of logo.
     *
     * @param mixed $logo the logo
     *
     * @return self
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }
}
?>