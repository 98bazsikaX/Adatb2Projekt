<?php

include 'abstract.php';


class airlines extends entity{
    protected $colour; //A legitarsasag szine

    function __construct($code,$name,$country,$colour="#FFFFFF")
    {
        entity::__construct($code,$name,$country);
        $this->colour = $colour;
    }

    function getFlights(){
        $retval = null;
        /*
        for jarat in adatbazis where $code == code idk
        */
        return $retval;
    }

    public function test(){
        echo "<p>mukodok</p>";
    }
}



?>