<?php

namespace Controllers;

use Models\JobOffer as JobOffer;
use Controllers\UserController as UserController;
use Utils\Utils as Utils;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\UserDAO as UserDAO;
use Models\Career;

class JobOfferController
{
    private $jobOfferDAO;
    private $JobPositionDAO;
    private $CompanyDAO;
    private $studentDAO;
    private $careerDAO;
    private $userDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->JobPositionDAO = new JobPositionDAO();
        $this->CompanyDAO = new CompanyDAO();
        $this->studentDAO = new StudentDAO();
        $this->careerDAO = new CareerDAO();
        $this->userDAO = new UserDAO();
    }

    public function add($companyId, $jobPositionId, $jobOffer_description, $limitDate, $flyer)
    {
        Utils::checkAdminCompanySession();

        if ($limitDate >= date("Y-m-d")) {
            $uploadedSuccess = Utils::UploadImage($flyer);
            if ($uploadedSuccess) {
                $jobOffer = new JobOffer();
                $jobOffer->setJobOffer_description($jobOffer_description);
                $jobOffer->setLimitDate($limitDate);
                $jobOffer->setState("Opened");
                $jobOffer->setCompanyId($companyId);
                $jobOffer->setJobPositionId($jobPositionId);
                $jobOffer->setFlyer($flyer['name']);

                $this->jobOfferDAO->add($jobOffer);
                $this->showListView();
            } else {
                $notImageError = true;
                require_once(VIEWS_PATH . "jobOffer-add.php");
            }
        } else {
            $invalidDate = true;
            $companies = $this->CompanyDAO->GetAll();
            $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();
            require_once(VIEWS_PATH . "jobOffer-add.php");
        }
    }

    public function Delete($jobOfferId)
    {
        Utils::checkAdminSession();
        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        if (isset($_SESSION['admin'])) {
            if ($jobOffer->getState() == "Opened") {
                $value = $this->jobOfferDAO->deleteJobOfferByID($jobOfferId);
                if ($value == 1) {
                    $jobOffers = $this->jobOfferDAO->GetList();
                    require_once(VIEWS_PATH . "jobOffer-list.php");
                }
            } else {
                $closedOffer = true;
                $companies = $this->CompanyDAO->GetAll();
                $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();
                $studentIdsList = $this->jobOfferDAO->GetStudentsByJobOffer($jobOfferId);
                $students = $this->studentDAO->GetFullStudentList($jobOffer->getStudentList());
                require_once(VIEWS_PATH . "admin-jobOffer-show.php");
            }
        }
    }

    public function RedirectAddFormJobOffer()
    {
        Utils::checkAdminCompanySession();

        $companies = $this->CompanyDAO->GetAll();
        $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();

        require_once(VIEWS_PATH . "jobOffer-add.php");
    }



    public function update($jobOfferId, $companyId, $jobPositionId, $jobOffer_description, $limitDate, $state, $students, $flyer)
    {
        Utils::checkAdminCompanySession();
        $companies = $this->CompanyDAO->GetAll();
        $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();
        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        $students = $this->studentDAO->GetFullStudentList($jobOffer->getStudentList());

        if ($jobOffer->getState() == "Opened") {
            if ($limitDate >= date("Y-m-d")) {
                $modifiedJobOffer = new JobOffer();
                $modifiedJobOffer->setJobOfferId($jobOfferId);
                $modifiedJobOffer->setJobOffer_description($jobOffer_description);
                $modifiedJobOffer->setLimitDate($limitDate);
                $modifiedJobOffer->setCompanyId($companyId);
                $modifiedJobOffer->setJobPositionId($jobPositionId);

                if ($flyer['error'] == 0) {
                    $uploadSuccess = Utils::UploadImage($flyer);

                    if ($uploadSuccess) {
                        $modifiedJobOffer->setFlyer($flyer['name']);
                    } else {
                        $updateSuccess = false;
                        $notImageError = true;
                        require_once(VIEWS_PATH . "admin-joboffer-show.php");
                    }
                }

                $this->jobOfferDAO->modify($modifiedJobOffer);

                $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
                $updateSuccess = true;
            } else {
                $invalidDate = true;
            }
        } else {
            $closedOffer = true;
        }
        require_once(VIEWS_PATH . "admin-jobOffer-show.php");
    }


    public function ShowListView()
    {
        Utils::checkSession();
        $careers = $this->careerDAO->GetAllActive();

        if (isset($_SESSION['admin'])) {
            $jobOffers = $this->jobOfferDAO->GetList();
        } else if (isset($_SESSION['student'])) {
            $user = $_SESSION['student'];
            $student = $this->studentDAO->GetByStudentId($user->getStudentId());
            $careerId = $student->getCareerId();
            $jobOffers = $this->jobOfferDAO->GetListByCareer($careerId);
        } else {
            $user = $_SESSION['company'];
            $jobOffers = $this->jobOfferDAO->GetListByCompanyId($user->getCompanyId());
        }
        if ($jobOffers == null) {
            $noOffersToShow = true;
        }

        require_once(VIEWS_PATH . "jobOffer-list.php");
    }

    public function ShowOffer($jobOfferId)
    {
        Utils::checkSession();
        $companies = $this->CompanyDAO->GetAll();
        $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();
        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        $students = $this->studentDAO->GetFullStudentList($jobOffer->getStudentList());

        if (isset($_SESSION['admin']) || isset($_SESSION['company'])) {
            require_once(VIEWS_PATH . "admin-jobOffer-show.php");
        } else if (isset($_SESSION['student'])) {
            $user = $_SESSION['student'];
            $studentId = $user->getStudentId();
            require_once(VIEWS_PATH . "student-jobOffer-show.php");
        }
    }



    public function Subscribe($jobOfferId)
    {
        $user = $_SESSION['student'];
        $studentId = $user->getStudentId();

        $this->jobOfferDAO->AddStudentToJobOffer($jobOfferId, $studentId);
        $SubscribeSuccess = true;

        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        require_once(VIEWS_PATH . "student-jobOffer-show.php");
    }

    public function FilterByCareer($careerId)
    {
        if ($careerId == 0) {
            $jobOffers = $this->jobOfferDAO->GetList();
        } else {
            $jobOffers = $this->jobOfferDAO->GetListByCareer($careerId);
        }
        $careers = $this->careerDAO->GetAllActive();

        require_once(VIEWS_PATH . "jobOffer-list.php");
    }

    public function FindCompanyInJobOffer($companyId)
    {
        $companyFound = false;
        $joboffers = $this->jobOfferDAO->GetListByCompanyId($companyId);
        if ($joboffers != null) {
            $companyFound = true;
        }
        return $companyFound;
    }

    public function ShowStudentList($jobOfferId)
    {
        Utils::checkSession();
        $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
        $students = $this->studentDAO->GetFullStudentList($jobOffer->getStudentList());
        $careers = $this->careerDAO->GetAllActive();
        $_SESSION['offerList'] = $jobOfferId;
        require_once(VIEWS_PATH . "student-list.php");
    }
}
