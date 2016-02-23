<?php
class concours extends bdd{
	
	protected $id;
	protected $name;
	protected $description;
	protected $start_date;
	protected $end_date;
	protected $ranking;
	protected $award;
	protected $status;
    protected $logo;
    protected $font;
	protected $font_color;
    protected $font_family;
    protected $background_color;
	protected $max_per_page;
	protected $methode_notification;
	protected $is_notify;
	
	
	public function __construct(){
		parent::__construct();
	}
	
	public function setFromBdd($var = []){
		foreach($var as $key => $value){
			$this->$key = (fonctions::is_serialized($value))?unserialize($value):$value;
		}
	}
	
	public function save($table = "concours"){
		$this->ranking = serialize($this->ranking);
		parent::save($table);
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
        return $this->start_date;
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
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Gets the value of endDate.
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
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
        $this->end_date = $endDate;

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

    /**
     * Gets the value of font.
     *
     * @return mixed
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Sets the value of font.
     *
     * @param mixed $font the font
     *
     * @return self
     */
    public function setFont($font)
    {
        $this->font = $font;

        return $this;
    }


 /**
     * Gets the value of font_color.
     *
     * @return mixed
     */
    public function getFontColor()
    {
        return $this->font_color;
    }

    /**
     * Sets the value of font_color.
     *
     * @param mixed $font_color the font family
     *
     * @return self
     */
    public function setFontColor($font_color)
    {
        $this->font_color = $font_color;

        return $this;
    }
	
	 /**
     * Gets the value of fontFamily.
     *
     * @return mixed
     */
    public function getBackgroundColor()
    {
        return $this->background_color;
    }

    /**
     * Sets the value of fontFamily.
     *
     * @param mixed $fontFamily the font family
     *
     * @return self
     */
    public function setBackgroundColor($background_color)
    {
        $this->background_color = $background_color;

        return $this;
    }
   
   
   public function setMax_per_page($max_per_page)
   {
	   $this->max_per_page = $max_per_page;
	   
	   return $this;
	   
   }
   
   public function getMax_per_page()
   {
	   return $this->max_per_page;
   }
   
   public function setMethode_notification($methode_notification)
   {
	   $this->methode_notification = $methode_notification;
	   
	   return $this;
	   
   }
   
   public function getMethode_notification()
   {
	   return $this->methode_notification;
   }
   
   public function setIs_notify($is_notify)
   {
	   $this->is_notify = $is_notify;
	   
	   return $this;
	   
   }
   
   public function getIs_notify()
   {
	   return $this->is_notify;
   }
   
}
?>