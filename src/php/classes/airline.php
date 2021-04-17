<?php

include 'abstract.php';


class airlines extends entity{

    function __construct($code=null,$name=null,$country=null)
    {
        parent::__construct($code,$name,$country);

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

    public static function byID($airline_id){
        //TODO: implementalni hogy az adatb alapjan ID alapjan is lehessen letrehozni legitarsasagot
        $retval = new airlines();
        $retval.setCountry();
        return $retval;
    }

    public function jsonEncode(){
        return json_encode(parent::jsonEncode());
    }

}



?>