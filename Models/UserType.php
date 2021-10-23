<?php
namespace Models;

class UserType {
    private $userTypeId;
    private $name;

    function __construct()
    {
    }

    /**
     * Get the value of userTypeId
     */ 
    public function getUserTypeId()
    {
        return $this->userTypeId;
    }

    /**
     * Set the value of userTypeId
     *
     * @return  self
     */ 
    public function setUserTypeId($userTypeId)
    {
        $this->userTypeId = $userTypeId;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}