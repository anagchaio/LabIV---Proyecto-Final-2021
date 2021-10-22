<?php namespace Models;

class JobPotion {

    private $jobPositionId;
    private $careerId;
    private $description;

    public function __construct()
    {
        
    }


    /**
     * Get the value of jobPositionId
     */ 
    public function getJobPositionId()
    {
        return $this->jobPositionId;
    }

    /**
     * Set the value of jobPositionId
     *
     * @return  self
     */ 
    public function setJobPositionId($jobPositionId)
    {
        $this->jobPositionId = $jobPositionId;

        return $this;
    }

    /**
     * Get the value of careerId
     */ 
    public function getCareerId()
    {
        return $this->careerId;
    }

    /**
     * Set the value of careerId
     *
     * @return  self
     */ 
    public function setCareerId($careerId)
    {
        $this->careerId = $careerId;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}

?>