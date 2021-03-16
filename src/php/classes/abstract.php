<?php

/*
*
* Ebben a fileban lesznek megtalalhatoak az abstract classok
* Peldalul, a repulotereknek es a legitarsasagoknak lehet egy kozos ose
*
*/ 


abstract class entity
{
    /*
    Az airlines es az airport classoknak kozos ose, hogy azokban csak 1-1 uj metodust, meg adattagot kelljen megadni.
    */
    //Properties
    protected $code;
    protected $name;
    protected $country;


    function __construct($code,$name,$country)
    {
        $this->code = $code;
        $this->name= $name;
        $this->country = $country;
        
    }

    abstract public function test();

}



?>