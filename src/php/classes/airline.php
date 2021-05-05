<?php

include 'abstract.php';


class airlines extends entity{

    private $abbr;
    function __construct($code,$name,$country,$abbr)
    {
        parent::__construct($code,$name,$country);
        $this->$abbr = $abbr;

    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * @param mixed $abbr
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
    }



    public function jsonEncode(){
        $rtv = array('code' => $this->code,
            'name'=> $this->name,
            'country'=>$this->country,
            'abbr'=>$this->abbr);
        return json_encode($rtv);
    }

}



?>