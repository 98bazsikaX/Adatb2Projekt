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

    public function test(){
        echo "<p>". parent::$code . $this->city . parent::$name. "</p>";
    }


}

?>