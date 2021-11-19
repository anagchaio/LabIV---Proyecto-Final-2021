<?php

namespace Controllers;

use Models\JobOffer as JobOffer;
use Models\Mail as Mail;
use Controllers\UserController as UserController;
use Utils\Utils as Utils;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\UserDAO as UserDAO;
use Models\Career;
use Controllers\FpdfController as FpdfController;
use \Exception as Exception;
use PHPMailer\PHPMailer\phpmailerException as phpmailerException;

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

    public function add($companyId, $companyName, $jobPositionId, $jobOffer_description, $limitDate, $flyer)
    {
        Utils::checkAdminCompanySession();
        try {
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
        } catch (Exception $exception) {
            //$DBerror = $exception->getMessage();
            echo $exception->getMessage();
            require_once(VIEWS_PATH . "jobOffer-add.php");
        }
    }

    public function Delete($jobOfferId)
    {
        Utils::checkAdminCompanySession();
        try {
            $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
           
                if ($jobOffer->getState() == "Opened") {
                    $value = $this->jobOfferDAO->deleteJobOfferByID($jobOfferId);
                    if ($value == 1) {
                        if (isset($_SESSION['admin'])){
                            $jobOffers = $this->jobOfferDAO->GetList();                            
                        }
                        if( isset($_SESSION['company'])){
                            $jobOffers = $this->jobOfferDAO->GetListByCompanyId($_SESSION['company']->getCompanyId());
                        }
                        require_once(VIEWS_PATH . "jobOffer-list.php");
                        
                    }
                } 
            
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function RedirectAddFormJobOffer()
    {
        Utils::checkAdminCompanySession();
        try {
            $companies = $this->CompanyDAO->GetAll();
            $jobPositions = $this->JobPositionDAO->GetAllActiveCareers();

            require_once(VIEWS_PATH . "jobOffer-add.php");
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }



    public function update($jobOfferId, $companyId,$companyName, $jobPositionId, $jobOffer_description, $limitDate, $state, $students, $flyer)
    {
        var_dump($jobOfferId);
        var_dump($companyId);
        var_dump($companyName);
        var_dump($jobPositionId);
        var_dump($jobOffer_description);
        var_dump($limitDate);
        var_dump($state);
        var_dump($students);
        var_dump($flyer);
        Utils::checkAdminCompanySession();
        try {
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
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }


    public function ShowListView()
    {
        Utils::checkSession();
        try {
            $careers = $this->careerDAO->GetAllActive();

            if (isset($_SESSION['admin'])) {
                $jobOffers = $this->jobOfferDAO->GetList();
            } else if (isset($_SESSION['student'])) {
                $user = $_SESSION['student'];
                $student = $this->studentDAO->GetByStudentId($user->getStudentId());
                $careerId = $student->getCareerId();
                $jobOffers = $this->jobOfferDAO->GetListByCareer($careerId);
                // die(var_dump($jobOffers));
            } else {
                $user = $_SESSION['company'];
                $jobOffers = $this->jobOfferDAO->GetListByCompanyId($user->getCompanyId());
            }
            if ($jobOffers == null) {
                $noOffersToShow = true;
            }
            require_once(VIEWS_PATH . "jobOffer-list.php");
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function ShowOffer($jobOfferId)
    {
        Utils::checkSession();
        try {
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
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function Close($jobOfferId)
    {
        Utils::checkAdminCompanySession();
        try {

            //me tengo que traer el array de alumnos los cuales aplicaron a la job offer

            $studentList = $this->jobOfferDAO->GetStudentsByJobOffer($jobOfferId);

            $this->createEmailJobOffer($studentList, $jobOfferId, 1);


             $this->jobOfferDAO->closeOffer($jobOfferId);

            $this->ShowOffer($jobOfferId);
        } catch (phpmailerException $ex) {
            Utils::ShowEmailError($ex->getMessage());
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }



    public function Subscribe($jobOfferId)
    {
        try {
            $user = $_SESSION['student'];
            $studentId = $user->getStudentId();

            $this->jobOfferDAO->AddStudentToJobOffer($jobOfferId, $studentId);
            $SubscribeSuccess = true;

            $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
            require_once(VIEWS_PATH . "student-jobOffer-show.php");
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function FilterByCareer($careerId)
    {
        try {
            if ($careerId == 0) {
                $jobOffers = $this->jobOfferDAO->GetList();
            } else {
                $jobOffers = $this->jobOfferDAO->GetListByCareer($careerId);
            }
            $careers = $this->careerDAO->GetAllActive();

            require_once(VIEWS_PATH . "jobOffer-list.php");
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function FindCompanyInJobOffer($companyId)
    {
        try {
            $companyFound = false;
            $joboffers = $this->jobOfferDAO->GetListByCompanyId($companyId);
            if ($joboffers != null) {
                $companyFound = true;
            }
            return $companyFound;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function ShowStudentList($jobOfferId)
    {
        try {
            Utils::checkSession();
            $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
            $students = $this->studentDAO->GetFullStudentList($jobOffer->getStudentList());
            $careers = $this->careerDAO->GetAllActive();
            if ($students) {
                $_SESSION['jobOffer'] = $jobOffer;
                require_once(VIEWS_PATH . "student-list.php");
            } else {
                require_once(VIEWS_PATH . "JobOffer-list.php");
            }
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function createPDFReport($jobOfferId)
    {
        try {
            Utils::checkAdminCompanySession();
            $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);
            $students = $this->studentDAO->GetFullStudentList($jobOffer->getStudentList());        
            
            $fpdfController = new FpdfController();
            $fpdfController->createPDF($students,$jobOffer);
            
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function SendEmailRegistration($email)
    {
        $student = $this->studentDAO->GetByStudentEmail($email);
        $this->studentDAO->generateEmail($email, $student);
        require_once(VIEWS_PATH . "student-firstpage.php");
    }


    public function createEmailJobOffer($studentList, $jobOfferId, $select)
    {
        try {

            $jobOffer = $this->jobOfferDAO->GetJobOffer($jobOfferId);


            if (!empty($studentList)) {

                $mail = new Mail();

                if ($select == 0) {
                    $mail->emailApplicationRejected($studentList, $jobOffer);
                } else if ($select == 1) {
                    foreach ($studentList as $student) {
                        $mail->emailEndJobOffer($student, $jobOffer);
                    }
                } else if ($select == 2) {
                    $mail->sendMailRegister($studentList);
                }
            }
        } catch (phpmailerException $ex) {
            throw $ex;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function rejectAplication($jobOfferId, $studentId)
    {
        try {

            $student = $this->studentDAO->GetByStudentId($studentId);

            $this->jobOfferDAO->deleteAplicationJobOffer($jobOfferId, $studentId);
            $this->createEmailJobOffer($student, $jobOfferId, 0);
            $this->ShowStudentList($jobOfferId);
        } catch (phpmailerException $ex) {
            Utils::ShowEmailError($ex->getMessage());
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }
}
