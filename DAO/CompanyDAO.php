<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use DAO\Connection as Connection;
    use \Exception as Exception;

//class CompanyDAO implements ICompanyDAO {
class CompanyDAO {
    // private $listOfCompanies = array();
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

    // public function GetByCompanyEmail($companyEmail)
    // {
    //     $this->RetrieveData();

    //     foreach ($this->listOfCompanies as $company) {
    //         if ($company->getEmail() == $companyEmail){
    //             return $company;
    //         }
    //     }

    //     return null;
    // }

    // public function GetByCompanyId($idCompany)
    // {
    //     $this->RetrieveData();

    //     foreach ($this->listOfCompanies as $company) {
    //         if ($company->getIdCompany() == $idCompany){
    //             return $company;
    //         }
    //     }

    //     return null;
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
        private $tableName = "company";

        public function Add(Company $company)
        {
            $response = NULL;
            try
            {

                $query = "INSERT INTO ".$this->tableName." (idCompany, name, yearFoundantion, city, description, logo, email, phoneNumber) 
                VALUES (:idCompany, :name, :yearFoundantion, :city, :description, :logo, :email, :phoneNumber);";
                
                $parameters["idCompany"] = $company->getIdCompany();
                $parameters["name"] = $company->getName();
                $parameters["yearFoundantion"] = $company->getYearFoundantion();
                $parameters["description"] = $company->getDescription();
                $parameters["city"] = $company->getCity();
                $parameters["logo"] = $company->getLogo();
                $parameters["email"] = $company->getEmail();
                $parameters["phoneNumber"] = $company->getPhoneNumber();

                $this->connection = Connection::GetInstance();

                $response = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
            }
            finally
            {
                return $response;
            }
        }

        public function GetAll()
        {
            $response = NULL;
            try
            {
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    
                    
                    $company = new Company();
                    $company->setIdCompany($row["idCompany"]);
                    $company->setName($row["name"]);
                    $company->setYearFoundantion($row["yearFoundantion"]);
                    $company->setDescription($row["description"]);
                    $company->setCity($row["city"]);
                    $company->setLogo($row["logo"]);
                    $company->setEmail($row["email"]);
                    $company->setPhoneNumber($row["phoneNumber"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
            }
            finally
            {
                return $response;
            }
            
        }
    
 
}
