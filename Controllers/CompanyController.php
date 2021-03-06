<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use DAO\UserDAO as UserDAO;
use Models\Company as Company;
use Models\User as User;
use Utils\Utils as Utils;
use Controllers\JobOfferController as JobOfferController;
use \Exception as Exception;

class CompanyController
{
    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->UserDAO = new UserDAO();
    }

    public function Register($email, $password)
    {
        try {
            $company = $this->companyDAO->GetByCompanyEmail($email);

            if ($company != null) {

                if ($this->UserDAO->getUserByEmail($email) == null) {
                    $newUser = new User();
                    $newUser->setEmail($email);
                    $newUser->setPassword($password);
                    $newUser->setName($company->getName());
                    $newUser->setCompanyId($company->getIdCompany());
                    $newUser->setUserTypeId(3);

                    $this->UserDAO->Add($newUser);

                    $succesfulRegistration = true;
                    require_once(VIEWS_PATH . "index.php");
                } else {
                    $registedEmail = true;
                    require_once(VIEWS_PATH . "company-user-registration.php");
                }
            } else {
                $invalidCompany = true;
                require_once(VIEWS_PATH . "company-add.php");
            }
        } catch (Exception $exception) {
            $DBerror = $exception->getMessage();            
            require_once(VIEWS_PATH . "company-user-registration.php");
        }
    }

    public function ShowListView()
    {
        Utils::checkSession();
        try {
            $companies = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH . "company-list.php");
        } catch (Exception $exception) {          
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function ShowCompany($idCompany)
    {
        Utils::checkSession();
        try {
            $company = $this->companyDAO->GetByCompanyId($idCompany);
            if (isset($_SESSION['admin']) || isset($_SESSION['company'])) {
                require_once(VIEWS_PATH . "admin-company-show.php");
            } else {
                require_once(VIEWS_PATH . "student-company-show.php");
            }
        } catch (Exception $exception) {
            $DBerror = $exception->getMessage();
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function RedirectAddForm()
    {
        Utils::checkAdminSession();
        require_once(VIEWS_PATH . "company-add.php");
    }

    public function RedirectShowForm()
    {
        Utils::checkAdminSession();
        require_once(VIEWS_PATH . "admin-company-show.php");
    }

    public function DeleteCompany($idCompany)
    {
        Utils::checkAdminSession();
        try {
            if (isset($_SESSION['admin'])) {
                $jobOfferController = new JobOfferController();
                $companyFound = $jobOfferController->FindCompanyInJobOffer($idCompany);
                if ($companyFound == false) {
                    $value = $this->companyDAO->deleteBD($idCompany);
                    if ($value == 1) {
                        $this->ShowListView();
                    }
                } else {
                    $companyInUse = true;
                    $company = $this->companyDAO->GetByCompanyId($idCompany);
                    require_once(VIEWS_PATH . "admin-company-show.php");
                }
            }
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function AddCompany($companyName, $yearFoundantion, $city, $email, $password, $phoneNumber, $description, $logo)
    {
        try {
            if ($this->companyDAO->GetByCompanyEmail($email) == null) {
                if ($yearFoundantion <= date("Y")) {
                    $uploadedSuccess = Utils::UploadImage($logo);
                    if ($uploadedSuccess) {
                        $newCompany = new Company();
                        $newCompany->setName($companyName);
                        $newCompany->setYearFoundantion($yearFoundantion);
                        $newCompany->setCity($city);
                        $newCompany->setDescription($description);
                        $newCompany->setEmail($email);
                        $newCompany->setPhoneNumber($phoneNumber);
                        $newCompany->setLogo($logo['name']);

                        $this->companyDAO->add($newCompany);

                        if (isset($_SESSION['admin'])) {
                            $this->ShowListView();
                        } else {
                            $this->Register($email, $password);
                        }
                    } else {
                        $notImageError = true;
                        require_once(VIEWS_PATH . "company-add.php");
                    }
                } else {
                    $yearNotValid = true;
                    require_once(VIEWS_PATH . "company-add.php");
                }
            } else {
                $usedCompanyEmail = true;
                require_once(VIEWS_PATH . "company-add.php");
            }
        } catch (Exception $exception) {
            // $DBerror = $exception->getMessage();
            echo $exception->getMessage();
            require_once(VIEWS_PATH . "company-add.php");
        }
    }


    public function ModifyCompany($companyId, $companyName, $yearFoundantion, $city, $email, $phoneNumber, $description, $logoName, $logo)
    {
        Utils::checkAdminCompanySession();
        try {
            $company = $this->companyDAO->GetByCompanyId($companyId);
            $updateSuccess = true;

            if ($company->getEmail() != $email) {
                if ($this->companyDAO->GetByCompanyEmail($email) != null) {
                    $updateSuccess = false;
                    $usedCompanyEmail = true;
                    require_once(VIEWS_PATH . "admin-company-show.php");
                } else {
                    $company->setEmail($email);
                }
            }

            if ($yearFoundantion <= date("Y")) {
                $company->setYearFoundantion($yearFoundantion);
            } else {
                $updateSuccess = false;
                $yearNotValid = true;
                require_once(VIEWS_PATH . "admin-company-show.php");
            }

            if ($logo['error'] == 0) {
                $uploadSuccess = Utils::UploadImage($logo);
                if ($uploadSuccess) {
                    $company->setLogo($logo['name']);
                } else {
                    $updateSuccess = false;
                    $notImageError = true;
                    require_once(VIEWS_PATH . "admin-company-show.php");
                }
            }

            $company->setName($companyName);
            $company->setCity($city);
            $company->setDescription($description);
            $company->setPhoneNumber($phoneNumber);

            if ($updateSuccess) {
                $this->companyDAO->modify($company);
                $successMessage = true;
                require_once(VIEWS_PATH . "admin-company-show.php");
            }
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }

    public function FilterList($searchedWord)
    {
        $searchedWord = strtolower($searchedWord);
        $filteredCompanies = array();
        try {
            foreach ($this->companyDAO->getAll() as $company) {
                $companyName = strtolower($company->getName());

                if (Utils::strStartsWith($companyName, $searchedWord)) {
                    array_push($filteredCompanies, $company);
                }
            }
            $companies = $filteredCompanies;
            require_once(VIEWS_PATH . "company-list.php");
        } catch (Exception $exception) {
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }
}
