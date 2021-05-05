<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
class User
{

    private $email;
    private $country;
    private $firstName;
    private $lastName;
    private $role;

    public function __toString()
    {
        return "név: $this->lastName $this->firstName , email: $this->email , role: $this->role";
    }

    public function toAssoc(){
        return array("email"=>$this->email,"country"=>$this->country,"first_name"=>$this->firstName,"last_name"=>$this->lastName,"role"=>$this->role);
    }


    /**
     * User constructor.
     * @param $email
     * @param $country
     * @param $firstName
     * @param $lastName
     * @param $role
     */
    public function __construct($email, $country, $firstName, $lastName, $role)
    {
        $this->email = $email;
        $this->country = $country;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function toString(){
        return "név: $this->lastName $this->firstName , email: $this->email , role: $this->role";
    }
}