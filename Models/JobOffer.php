<?php
namespace Models;

class JobOffer {

    private $jobOfferId;
    private $jobOffer_description;
    private $limitDate;
    private $state;
    private $companyId;
    private $jobPositionId;
    private $userId;
    private $company_name;
    private $jobPosition_description;
    private $career_description;
    private $flyer;

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
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of companyId
     */ 
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set the value of companyId
     *
     * @return  self
     */ 
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

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
        return $this->career_description;
    }

    /**
     * Set the value of career_description
     *
     * @return  self
     */ 
    public function setCareer_description($career_description)
    {
        $this->career_description = $career_description;

        return $this;
    }


    /**
     * Get the value of company_name
     */ 
    public function getCompany_name()
    {
        return $this->company_name;
    }

    /**
     * Set the value of company_name
     *
     * @return  self
     */ 
    public function setCompany_name($company_name)
    {
        $this->company_name = $company_name;

        return $this;
    }

    /**
     * Get the value of flyer
     */ 
    public function getFlyer()
    {
        return $this->flyer;
    }

    /**
     * Set the value of flyer
     *
     * @return  self
     */ 
    public function setFlyer($flyer)
    {
        $this->flyer = $flyer;

        return $this;
    }
}