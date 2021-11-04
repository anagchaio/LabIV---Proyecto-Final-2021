<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use Utils\Utils as Utils;
use Controllers\JobOfferController as JobOfferController;

class CompanyController
{
    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
    }

    public function ShowListView()
    {
        Utils::checkSession();
        $companies = $this->companyDAO->GetAll();
        require_once(VIEWS_PATH . "company-list.php");
    }

    public function ShowCompany($idCompany)
    {
        Utils::checkSession();
        $company = $this->companyDAO->GetByCompanyId($idCompany);
        if (isset($_SESSION['admin'])) {
            require_once(VIEWS_PATH . "admin-company-show.php");
        } else {
            require_once(VIEWS_PATH . "student-company-show.php");
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
        if (isset($_SESSION['admin'])) {
            $jobOfferController = new JobOfferController();
            $companyFound = $jobOfferController->FindCompanyInJobOffer($idCompany);
            if($companyFound == false){
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
    }

    public function AddCompany($companyName, $yearFoundantion, $city, $email, $phoneNumber,$description, $logo)
    {
        Utils::checkAdminSession();
        if ($this->companyDAO->GetByCompanyEmail($email) == null) {
            if ($yearFoundantion <= date("Y")) {
                $uploadedSuccess = $this->companyDAO->UploadLogo($logo);
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
                    $this->ShowListView();
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
    }


    public function ModifyCompany($companyId, $companyName, $yearFoundantion, $city, $description, $email, $phoneNumber, $logoName, $logo)
    {
        Utils::checkAdminSession();
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
            $uploadSuccess = $this->companyDAO->UploadLogo($logo);
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

        if($updateSuccess){
            $this->companyDAO->modify($company);
            $successMessage = true;
            require_once(VIEWS_PATH . "admin-company-show.php");
        }
        
    }

    public function FilterList($searchedWord)
    {

        $searchedWord = strtolower($searchedWord);
        $filteredCompanies = array();
        foreach ($this->companyDAO->getAll() as $company) {
            $companyName = strtolower($company->getName());

            if (Utils::strStartsWith($companyName, $searchedWord)) {
                array_push($filteredCompanies, $company);
            }
        }
        $companies = $filteredCompanies;
        require_once(VIEWS_PATH . "company-list.php");
    }
}
