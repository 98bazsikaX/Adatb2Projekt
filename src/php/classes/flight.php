<?php
/*
 *
 * Class az utakhoz php-ban, főleg json-ná alakítás miatt
 *
 */

class flight
{
    private $flightNumber; //string
    private $airplane;  //airplane objektum -> ennek van egy airline objektuma
    private $price;     //integer?
    private $departure; //airport objektum
    private $destination; //airport objektum
    private $departureTime; //date-time
    private $arrivalTime; //date-time

    /**
     * flight constructor.
     * @param $flightNumber
     * @param $airplane
     * @param $price
     * @param $departure
     * @param $destination
     * @param $departureTime
     * @param $arrivalTime
     */
    public function __construct($flightNumber, $airplane, $price, $departure, $destination, $departureTime, $arrivalTime)
    {
        $this->flightNumber = $flightNumber;
        $this->airplane = $airplane;
        $this->price = $price;
        $this->departure = $departure;
        $this->destination = $destination;
        $this->departureTime = $departureTime;
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * @return mixed
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * @return mixed
     */
    public function getAirplane()
    {
        return $this->airplane;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return mixed
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @return mixed
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }



}