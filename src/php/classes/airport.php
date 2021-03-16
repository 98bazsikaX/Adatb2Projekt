<?php

include 'abstract.php';

class airport extends entity{
    protected $city;


    function __construct($code,$name,$country,$city){
        parent::__construct($code,$name,$country);
        $this->city = $city;
    }

    function getArrivals(){
        return null;
    }

    function getDepartures(){
        return null;
    }

    public function jsonEncode(){
        $retval = parent::jsonEncode();
        $retval['city']=$this->city;
        return json_encode($retval);
    }


}

?>