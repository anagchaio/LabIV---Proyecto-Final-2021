<?php

namespace Controllers;

use Models\JobOffer as JobOffer;
use Controllers\UserController as UserController;
use Utils\Utils as Utils;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\StudentDAO as StudentDAO;

class JobOfferController
{
    private $jobOfferDAO;
    private $JobPositionDAO;
    private $CompanyDAO;
    private $studentDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->JobPositionDAO = new JobPositionDAO();
        $this->CompanyDAO = new CompanyDAO();
        $this->studentDAO = new StudentDAO();
    }

    public function add($companyId, $jobPositionId, $jobOffer_description, $limitDate)
    {
        Utils::checkAdminSession();

        if ($limitDate >= date("Y-m-d")) {
            $jobOffer = new JobOffer();
            $jobOffer->setJobOffer_description($jobOffer_description);
            $jobOffer->setLimitDate($limitDate);
            $jobOffer->setState("Opened");
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setStudentId(null);

            $this->jobOfferDAO->add($jobOffer);
            $this->showListView();

        } else {
            $invalidDate = true;
            require_once(VIEWS_PATH . "jobOffer-add.php");
        }
    }

    public function RedirectAddFormJobOffer()
    {
        Utils::checkAdminSession();

        $companies = $this->CompanyDAO->GetAll();
        $jobPositions = $this->JobPositionDAO->GetAll();

        require_once(VIEWS_PATH . "jobOffer-add.php");
    }



    public function update($jobOfferId, $companyId, $jobPositionId, $jobOffer_description, $limitDate, $state)
    {
        Utils::checkAdminSession();
        
        if ($limitDate >= date("Y-m-d")) {
            $jobOffer = new JobOffer();
            $jobOffer->setJobOfferId($jobOfferId);
            $jobOffer->setJobOffer_description($jobOffer_description);
            $jobOffer->setLimitDate($limitDate);
            $jobOffer->setState($state);
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setJobPositionId($jobPositionId);

           $this->jobOfferDAO->modify($jobOffer);
           $updateSuccess = true;
           $this->ShowOffer($jobOfferId);

        } else {
            $invalidDate = true;
            $this->ShowOffer($jobOfferId);
        }
    }

    //method, DAO, view
    public function delete()
    {
    }

    public function ShowListView()
    {
        Utils::checkAdminSession();
        $jobOffers = $this->jobOfferDAO->GetList();
        require_once(VIEWS_PATH . "admin-jobOffer-list.php");
    }

    public function ShowOffer($jobOfferId)
    {
        Utils::checkAdminSession();

        $companies = $this->CompanyDAO->GetAll();
        $jobPositions = $this->JobPositionDAO->GetAll();
        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        $student = $this->studentDAO->GetByStudentId($jobOffer->getStudentId());

        require_once(VIEWS_PATH . "admin-jobOffer-show.php");
    }
}
