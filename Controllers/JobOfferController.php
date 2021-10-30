<?php

namespace Controllers;

use Models\JobOffer as JobOffer;
use Controllers\UserController as UserController;
use Utils\Utils as Utils;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;

class JobOfferController {
    private $jobOfferDAO;
    private $JobPositionDAO;
    private $CompanyDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->JobPositionDAO = new JobPositionDAO();
        $this->CompanyDAO = new CompanyDAO();
    }

    //method, view
    public function add($jobOfferId="", $jobOffer_description="", $limitDate="", $state="", $companyId="", 
    $jobPositionId="", $userId="", $company_name="", $jobPosition_description="",$career_description="",$studentId){
        Utils::checkAdminSession();

            $jobOffer = new JobOffer();
            $jobOffer->setJobOfferId($jobOfferId);
            $jobOffer->setJobOffer_description($jobOffer_description);
            $jobOffer->setLimitDate($limitDate);
            $jobOffer->setState($state);
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setUserId($userId);
            $jobOffer->setCompany_name($company_name);
            $jobOffer->setJobPosition_description($jobPosition_description);
            $jobOffer->setCareer_description($career_description);
            $jobOffer->setStudentId($studentId);

            $this->jobOfferDAO->add($jobOffer);
  

            $this->showListView();

    }

    public function RedirectAddFormJobOffer()
    {
        Utils::checkAdminSession();
        $jobPositions = $this->JobPositionDAO->GetAll();
        $companies = $this->CompanyDAO->GetAll();

        require_once(VIEWS_PATH . "jobOffer-add.php");
    }



    //method, DAO, view
    public function update() {

    }

    //method, DAO, view
    public function delete() {

    }

    public function ShowListView() {
        Utils::checkSession();
        $jobOffers = $this->jobOfferDAO->GetList();
        require_once(VIEWS_PATH . "jobOffer-list.php");
    }

}