<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use DAO\Connection as Connection;
use \Exception as Exception;

//class CompanyDAO implements ICompanyDAO {
class CompanyDAO
{

    // private $fileName;

    // public function __construct()
    // {
    //     $this->fileName = ROOT . "Data/companies.json";
    // }

    // private function retrieveData()
    // {
    //     $this->listOfCompanies = array();
    //     if (file_exists($this->fileName)) {
    //         $jsonContent = file_get_contents($this->fileName);
    //         $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

    //         foreach ($arrayToDecode as $values) {
    //             $company = new Company();
    //             $company->setIdCompany($values['idCompany']);
    //             $company->setName($values['name']);
    //             $company->setYearFoundantion($values['yearFoundantion']);
    //             $company->setDescription(($values['description']));
    //             $company->setCity($values['city']);
    //             $company->setLogo($values['logo']);
    //             $company->setEmail($values['email']);
    //             $company->setPhoneNumber($values['phoneNumber']);
    //             array_push($this->listOfCompanies, $company);
    //         }
    //     }
    // }

    // private function saveData()
    // {
    //     $arrayToEncode = array();

    //     foreach ($this->listOfCompanies as $company) {
    //         $values['idCompany'] = $company->getIdCompany();
    //         $values['name'] = $company->getName();
    //         $values['yearFoundantion'] = $company->getYearFoundantion();
    //         $values['description'] = $company->getDescription();
    //         $values['city'] = $company->getCity();
    //         $values['logo'] = $company->getLogo();
    //         $values['email'] = $company->getEmail();
    //         $values['phoneNumber'] = $company->getPhoneNumber();
    //         array_push($arrayToEncode, $values);
    //     }
    //     $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
    //     file_put_contents($this->fileName, $jsonContent);
    // }

    // public function add(Company $company)
    // {
    //     $this->retrieveData();
    //     array_push($this->listOfCompanies, $company);
    //     $this->saveData();
    // }

    // public function delete(Company $companyToDelete)
    // {
    //     $this->retrieveData();
    //     foreach ($this->listOfCompanies as $company) {
    //         if ($companyToDelete->getIdCompany() == $company->getIdCompany()) {
    //             $key = array_search($company, $this->listOfCompanies);
    //             unset($this->listOfCompanies[$key]);
    //         }
    //     }
    //     $this->saveData();
    // }

    // public function getAll()
    // {
    //     $this->retrieveData();
    //     return $this->listOfCompanies;
    // }





    // public function getCompanyLastId(){
    //     $id = 1;
    //     if(count($this->listOfCompanies) > 0){
    //         $company = end($this->listOfCompanies);
    //         $id = $company->getIdCompany() + 1;
    //     }
    //     return $id;
    // }

    // public function modifyCompany(Company $modifiedCompany)
    // {
    //     $this->RetrieveData();

    //     foreach ($this->listOfCompanies as $company) {
    //         if ($company->getIdCompany() == $modifiedCompany->getIdCompany()){
    //             $key = array_search($company, $this->listOfCompanies);
    //             $this->listOfCompanies[$key] = $modifiedCompany;

    //         }
    //     }

    //     $this->saveData();
    // }


    private $connection;
    private $tableName = "companies";
    private $listOfCompanies = array();

    public function Add(Company $company)
    {
        $response = NULL;
        try {

            $query = "INSERT INTO " . $this->tableName . " (company_name, yearFoundantion, city, description, logo, email, phonenumber) 
                VALUES (:company_name, :yearFoundantion, :city, :description, :logo, :email, :phonenumber);";

            $parameters["company_name"] = $company->getName();
            $parameters["yearFoundantion"] = $company->getYearFoundantion();
            $parameters["city"] = $company->getCity();
            $parameters["description"] = $company->getDescription();
            $parameters["logo"] = $company->getLogo();
            $parameters["email"] = $company->getEmail();
            $parameters["phonenumber"] = $company->getPhoneNumber();
            
            $this->connection = Connection::GetInstance();
            return $this->connection->ExecuteNonQuery($query, $parameters);

        } catch (Exception $exception) {
            $response = $exception->getMessage();
            var_dump($response);
        }
    }

    public function GetAll()
    {
        $response = NULL;
        try {
            $companyList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $company = new Company();
                $company->setIdCompany($row["id_company"]);
                $company->setName($row["company_name"]);
                $company->setYearFoundantion($row["yearFoundantion"]);
                $company->setDescription($row["description"]);
                $company->setCity($row["city"]);
                $company->setLogo($row["logo"]);
                $company->setEmail($row["email"]);
                $company->setPhoneNumber($row["phonenumber"]);

                array_push($companyList, $company);
            }

            return $companyList;
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function GetByCompanyId($idCompany)
    {
        $foundCompany = null;
        $this->listOfCompanies = $this->GetAll();
        if ($this->listOfCompanies != null) {
            foreach ($this->listOfCompanies as $company) {
                if ($company->getIdCompany() == $idCompany) {
                    $foundCompany = $company;
                }
            }
        }
        return $foundCompany;
    }

    public function GetByCompanyEmail($companyEmail)
    {
        $foundCompany = null;
        $this->listOfCompanies = $this->GetAll();
        if ($this->listOfCompanies != null) {
            foreach ($this->listOfCompanies as $company) {
                if ($company->getEmail() == $companyEmail) {
                    $foundCompany = $company;
                }
            }
        }
        return $foundCompany;
    }


    public function UploadLogo($logo)
    {
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
            }
        } else {
            $notImageError = true;
        }
        return $uploadSuccess;
    }


    public function modify(Company $company){
        try {

            $query = "UPDATE ". $this->tableName ." SET company_name=:company_name, yearFoundantion=:yearFoundantion,
            city=:city, description=:description, logo=:logo, email=:email, phonenumber=:phonenumber
            WHERE id_company = :id_company;";

            $parameters["id_company"] = $company->getIdCompany();
            $parameters["company_name"] = $company->getName();
            $parameters["yearFoundantion"] = $company->getYearFoundantion();
            $parameters["city"] = $company->getCity();
            $parameters["description"] = $company->getDescription();
            $parameters["logo"] = $company->getLogo();
            $parameters["email"] = $company->getEmail();
            $parameters["phonenumber"] = $company->getPhoneNumber();

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
            
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }
}
