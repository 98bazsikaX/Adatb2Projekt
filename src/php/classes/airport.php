<?php

include 'abstract.php';

class airport extends entity{
    protected $city;


    function __construct($code,$name,$country,$city){
        entity::__construct($code,$name,$country);
        $this->city = $city;
    }

    function getArrivals(){
        return null;
    }

    function getDepartures(){
        return null;
    }

    public function test(){
        echo "<p>". entity::$code. $city . entity::$name. "</p>";
    }


}

?>