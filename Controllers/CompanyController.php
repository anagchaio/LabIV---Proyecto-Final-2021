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

        public function ShowCompany($idCompany)
        {
            Utils::checkSession();
            $company = $this->companyDAO->GetByCompanyId($idCompany);

           // require_once(VIEWS_PATH."company-show.php");
        }

        public function AddCompany($companyName,$yearFoundantion, $city, $description, $email, $phoneNumber, $logo){
            
            Utils::checkSession();
            if ($this->companyDAO->GetByCompanyEmail($email) == null) {
                $newCompany = new Company();
                $newCompany->setIdCompany($this->companyDAO->getCompanyLastId());
                $newCompany->setName($companyName);
                $newCompany->setYearFoundantion($yearFoundantion);
                $newCompany->setCity($city);
                $newCompany->setDescription($description);
                $newCompany->setEmail($email);
                $newCompany->setPhoneNumber($phoneNumber);
                $uploadSuccess = $this->UploadLogo($logo);
                $newCompany->setLogo($logo);
                if($uploadSuccess){
                    $this->companyDAO->add($newCompany);
                    require_once(VIEWS_PATH."company-show.php");
                }

            } else {
                $usedCompanyEmail = true;
                require_once(VIEWS_PATH."company-add.php");
            }
        }

        public function UploadLogo($logo)
        {
            $uploadSuccess = false;
            $fileName = $logo["name"];
            $tempFileName = $logo["tmp_name"];
            $type = $logo["type"];
            
            $filePath = UPLOADS_PATH.basename($fileName);            

            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName); //se puede usar

            if(in_array($type,IMAGES_TYPE)){
                if (move_uploaded_file($tempFileName, $filePath))
                {
                    $uploadSuccess = true;
                    
                } else {
                    $uploadError = true;
                    require_once(VIEWS_PATH."company-add.php");
                }
                    
            } else {
                $notImageError = true;
                require_once(VIEWS_PATH."company-add.php");
            }
            return $uploadSuccess;
        }
    }
