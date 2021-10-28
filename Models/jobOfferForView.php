<?php
namespace Models;

class JobOfferForView {
    private $jobOfferId;
    private $companyName;
    private $jobOffer_description;
    private $jobPosition_description;
    private $career_description;
    private $limitDate;
    private $state;
    private $studentId;

    public function __construct(){
       
    }
    






    /**
     * Get the value of jobOfferId
     */ 
    public function getJobOfferId()
    {
        return $this->jobOfferId;
    }

    /**
     * Set the value of jobOfferId
     *
     * @return  self
     */ 
    public function setJobOfferId($jobOfferId)
    {
        $this->jobOfferId = $jobOfferId;

        return $this;
    }

    /**
     * Get the value of companyName
     */ 
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set the value of companyName
     *
     * @return  self
     */ 
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get the value of jobOffer_description
     */ 
    public function getJobOffer_description()
    {
        return $this->jobOffer_description;
    }

    /**
     * Set the value of jobOffer_description
     *
     * @return  self
     */ 
    public function setJobOffer_description($jobOffer_description)
    {
        $this->jobOffer_description = $jobOffer_description;

        return $this;
    }

    /**
     * Get the value of jobPosition_description
     */ 
    public function getJobPosition_description()
    {
        return $this->jobPosition_description;
    }

    /**
     * Set the value of jobPosition_description
     *
     * @return  self
     */ 
    public function setJobPosition_description($jobPosition_description)
    {
        $this->jobPosition_description = $jobPosition_description;

        return $this;
    }

    /**
     * Get the value of career_description
     */ 
    public function getCareer_description()
    {
        return $this->career_dedescription;
    }

    /**
     * Set the value of career_description
     *
     * @return  self
     */ 
    public function setCareer_description($career_dedescription)
    {
        $this->career_dedescription = $career_dedescription;

        return $this;
    }

    /**
     * Get the value of limitDate
     */ 
    public function getLimitDate()
    {
        return $this->limitDate;
    }

    /**
     * Set the value of limitDate
     *
     * @return  self
     */ 
    public function setLimitDate($limitDate)
    {
        $this->limitDate = $limitDate;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of studentId
     */ 
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * Set the value of studentId
     *
     * @return  self
     */ 
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;

        return $this;
    }
}