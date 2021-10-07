<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
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
            $company = $this->companyDAO->GetByCompanyName($companyName);

           // require_once(VIEWS_PATH."company-show.php");
        }

    }    
?>