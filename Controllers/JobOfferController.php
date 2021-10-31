<?php

namespace Controllers;

use Models\JobOffer as JobOffer;
use Controllers\UserController as UserController;
use Utils\Utils as Utils;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;

class JobOfferController
{
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
    public function add($companyId, $jobPositionId, $jobOffer_description, $limitDate)
    {
        Utils::checkAdminSession();

        $jobOffer = new JobOffer();
        $jobOffer->setJobOffer_description($jobOffer_description);
        $jobOffer->setLimitDate($limitDate);
        $jobOffer->setState("Opened");
        $jobOffer->setCompanyId($companyId);
        $jobOffer->setJobPositionId($jobPositionId);
        $jobOffer->setStudentId(null);

        $this->jobOfferDAO->add($jobOffer);
        if (isset($response)) {
            die(var_dump($response));
        }

        $this->showListView();
    }

    public function RedirectAddFormJobOffer()
    {
        Utils::checkAdminSession();


        $companies = $this->CompanyDAO->GetAll();
        if (isset($response)) {
            var_dump($response);
        }
        $jobPositions = $this->JobPositionDAO->GetAll();

        require_once(VIEWS_PATH . "jobOffer-add.php");
    }



    //method, DAO, view
    public function update()
    {
    }

    //method, DAO, view
    public function delete()
    {
    }

    public function ShowListView()
    {
        Utils::checkSession();
        $jobOffers = $this->jobOfferDAO->GetList();
        require_once(VIEWS_PATH . "jobOffer-list.php");
    }
}
