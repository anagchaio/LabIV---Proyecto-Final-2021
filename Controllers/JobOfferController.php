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
        $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();

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
        Utils::checkSession();
        if (isset($_SESSION['admin'])) {
            $jobOffers = $this->jobOfferDAO->GetList();
        } else {
            $user = $_SESSION['student'];
            $student = $this->studentDAO->GetByStudentId($user->getStudentId());
            $careerId = $student->getCareerId();
            $jobOffers = $this->jobOfferDAO->GetListByCareer($careerId);
        }

        require_once(VIEWS_PATH . "jobOffer-list.php");
    }


    public function ShowOffer($jobOfferId)
    {
        Utils::checkSession();
        $companies = $this->CompanyDAO->GetAll();
        $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();
        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        
        if (isset($_SESSION['admin'])) {
            $student = $this->studentDAO->GetByStudentId($jobOffer->getStudentId());
            require_once(VIEWS_PATH . "admin-jobOffer-show.php");

        } else {
            $user = $_SESSION['student'];
            $student = $this->studentDAO->GetByStudentId($user->getStudentId());
            
            require_once(VIEWS_PATH . "student-jobOffer-show.php");
        }
    }

    public function Subscribe($jobOfferId){

        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        $user = $_SESSION['student'];
        $studentId = $user->getStudentId();

        $this->jobOfferDAO->AddStudent($jobOffer, $studentId);


    }
}
