<?php


class airplane
{
    private $aircraftRegistration; //lajstromjel
    private $airlineID; //number," A repülőgép azonosítója a légitársaságon belül"
    private $airLine; //airline objektum
    private $type;  //string
    private $nrOfSeats; //number

    /**
     * airplane constructor.
     * @param $aircraftRegistration
     * @param $airlineID
     * @param $airLine
     * @param $type
     * @param $nrOfSeats
     */
    public function __construct($aircraftRegistration, $airlineID, $airLine, $type, $nrOfSeats)
    {
        $this->aircraftRegistration = $aircraftRegistration;
        $this->airlineID = $airlineID;
        $this->airLine = $airLine;
        $this->type = $type;
        $this->nrOfSeats = $nrOfSeats;
    }

    /**
     * @return mixed
     */
    public function getAircraftRegistration()
    {
        return $this->aircraftRegistration;
    }

    /**
     * @return mixed
     */
    public function getAirlineID()
    {
        return $this->airlineID;
    }

    /**
     * @return mixed
     */
    public function getAirLine()
    {
        return $this->airLine;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getNrOfSeats()
    {
        return $this->nrOfSeats;
    }




}