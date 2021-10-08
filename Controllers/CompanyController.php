<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company;
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
            //require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowCompany($companyName)
        {
            Utils::checkSession();
            $company = $this->companyDAO->GetByCompanyName($companyName);

           // require_once(VIEWS_PATH."company-show.php");
        }

        public function AddCompany($companyName,$yearFoundantion, $city, $description, $logo, $email, $phoneNumber){
            
            Utils::checkSession();
            if ($this->companyDAO->GetByCompanyName($companyName) == null) {

                $newCompany = new Company();
                $newCompany->setIdCompany($this->companyDAO->getCompanyLastId());
                $newCompany->setName($companyName);
                $newCompany->setYearFoundantion($yearFoundantion);
                $newCompany->setCity($city);
                $newCompany->setDescription($description);
                $newCompany->setLogo($logo);
                $newCompany->setEmail($email);
                $newCompany->setPhoneNumber($phoneNumber);

                $this->companyDAO->add($newCompany);

                require_once(VIEWS_PATH."company-list.php");
            } else {
                $usedCompanyName = true;
                require_once(VIEWS_PATH."company-add.php");
            }
        }

    }    
?>