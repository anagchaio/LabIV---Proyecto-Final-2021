<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use Utils\Utils as Utils;

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
        //Utils::checkAdminSession();
        require_once(VIEWS_PATH . "admin-company-show.php");
    }

    public function DeleteCompany($idCompany)
    {
        Utils::checkAdminSession();
        if (isset($_SESSION['admin'])) {
            $company = $this->companyDAO->GetByCompanyId($idCompany);
            $this->companyDAO->delete($company);
            $this->ShowListView();
        }
    }

    public function AddCompany($companyName, $yearFoundantion, $city, $description, $email, $phoneNumber, $logo)
    {
        Utils::checkAdminSession();
        if ($this->companyDAO->GetByCompanyEmail($email) == null) {
            if($yearFoundantion <= date("Y")){

                $newCompany = new Company();
                $newCompany->setIdCompany($this->companyDAO->getCompanyLastId());
                $newCompany->setName($companyName);
                $newCompany->setYearFoundantion($yearFoundantion);
                $newCompany->setCity($city);
                $newCompany->setDescription($description);
                $newCompany->setEmail($email);
                $newCompany->setPhoneNumber($phoneNumber);
                $uploadSuccess = $this->UploadLogo($logo, "company-add.php");
                $newCompany->setLogo($logo);
                if ($uploadSuccess) {
                    $this->companyDAO->add($newCompany);
                    $company = $newCompany;
                    $companyId = $newCompany->getIdCompany();
                    $this->ShowListView();
                }

            }else {
                $yearNotValid = true;
                require_once(VIEWS_PATH . "company-add.php");
            }
            
        } else {
            $usedCompanyEmail = true;
            require_once(VIEWS_PATH . "company-add.php");
        }
    }


    public function UploadLogo($logo, $fileView)
    {
        Utils::checkAdminSession();
        $uploadSuccess = false;
        $fileName = $logo["name"];
        $tempFileName = $logo["tmp_name"];
        $type = $logo["type"];

        $filePath = UPLOADS_PATH . basename($fileName);

        if (in_array($type, IMAGES_TYPE)) {
            if (move_uploaded_file($tempFileName, $filePath)) {
                $uploadSuccess = true;
            } else {
                $uploadError = true;
                require_once(VIEWS_PATH . $fileView); 
            }
        } else {
            $notImageError = true;
            require_once(VIEWS_PATH . $fileView); 
        }
        return $uploadSuccess;
    }

    public function ModifyCompany($companyId, $companyName, $yearFoundantion, $city, $description, $email, $phoneNumber, $logoName, $logo)
    {
        Utils::checkAdminSession();
        $company = $this->companyDAO->GetByCompanyId($companyId);

        if ($company->getEmail() != $email) {
            if ($this->companyDAO->GetByCompanyEmail($email) != null) {
                $usedCompanyEmail = true;
                require_once(VIEWS_PATH . "admin-company-show.php");
            } else {
                $company->setEmail($email);
            }
        }
        $company->setName($companyName);
        $company->setYearFoundantion($yearFoundantion);
        $company->setCity($city);
        $company->setDescription($description);
        $company->setEmail($email);
        $company->setPhoneNumber($phoneNumber);
        if ($logo['error'] == 0) {
            $uploadSuccess = $this->UploadLogo($logo, "admin-company-show.php");
            if($uploadSuccess){
                $company->setLogo($logo);
            }
        }
        $this->companyDAO->modifyCompany($company);

        $this->ShowListView();
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
