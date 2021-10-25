<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;

class CompanyDAO implements ICompanyDAO
{
    private $listOfCompanies = array();
    private $fileName;

    private $connection;
    private $tableName = "company";

    public function __construct()
    {
        $this->fileName = ROOT . "Data/companies.json";
    }

    private function retrieveData()
    {
        $this->listOfCompanies = array();
        if (file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $values) {
                $company = new Company();
                $company->setIdCompany($values['idCompany']);
                $company->setName($values['name']);
                $company->setYearFoundantion($values['yearFoundantion']);
                $company->setDescription(($values['description']));
                $company->setCity($values['city']);
                $company->setLogo($values['logo']);
                $company->setEmail($values['email']);
                $company->setPhoneNumber($values['phoneNumber']);
                array_push($this->listOfCompanies, $company);
            }
        }
    }

    private function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->listOfCompanies as $company) {
            $values['idCompany'] = $company->getIdCompany();
            $values['name'] = $company->getName();
            $values['yearFoundantion'] = $company->getYearFoundantion();
            $values['description'] = $company->getDescription();
            $values['city'] = $company->getCity();
            $values['logo'] = $company->getLogo();
            $values['email'] = $company->getEmail();
            $values['phoneNumber'] = $company->getPhoneNumber();
            array_push($arrayToEncode, $values);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function add(Company $company)
    {
        $response = NULL;
        try
        {
            $companyInsertquery = "INSERT INTO ".$this->tableName." (idCompany, name, yearFoundation, city, description, logo, email,phoneNumber) 
            VALUES (:idCompany, :name, :yearFoundation, :city, :description, :logo, :email, :phoneNumber);";
            
            $parameters["idCompany"] = $company->getIdCompany();
            $parameters["name"] = $company->getName();
            $parameters["yearFoundation"] = $company->getYearFoundantion();
            $parameters["city"] = $company->getCity();
            $parameters["description"] = $company->getDescription();
            $parameters["logo"] = $company->getLogo();
            $parameters["email"] = $company->getEmail();
            $parameters["phoneNumber"] = $company->getPhoneNumber();

            $this->connection = Connection::GetInstance();

            $response = $this->connection->ExecuteNonQuery($companyInsertquery, $parameters);
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

    public function delete(Company $companyToDelete)
    {
        $this->retrieveData();
        foreach ($this->listOfCompanies as $company) {
            if ($companyToDelete->getIdCompany() == $company->getIdCompany()) {
                $key = array_search($company, $this->listOfCompanies);
                unset($this->listOfCompanies[$key]);
            }
        }
        $this->saveData();
    }

    public function getAll()
    {
        $response = NULL;
        try
        {
            $companyList = array();

            $companyQuery = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($companyQuery);

            foreach ($resultSet as $row)
            {                
                $company = new Company();
                $company->setIdCompany($row["id_company"]);
                $company->setName($row["name"]);
                $company->setYearFoundantion($row["yearFoundation"]);
                $company->setCity($row["city"]);
                $company->setDescription($row["description"]);
                $company->setLogo($row["logo"]);
                $company->setEmail($row["email"]);
                $company->setPhoneNumber($row["phonenumber"]);

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

    public function GetByCompanyEmail($companyEmail)
    {
        $this->RetrieveData();

        foreach ($this->listOfCompanies as $company) {
            if ($company->getEmail() == $companyEmail){
                return $company;
            }
        }

        return null;
    }

    public function GetByCompanyId($idCompany)
    {
        $this->RetrieveData();

        foreach ($this->listOfCompanies as $company) {
            if ($company->getIdCompany() == $idCompany){
                return $company;
            }
        }

        return null;
    }

    public function getCompanyLastId(){
        $id = 1;
        if(count($this->listOfCompanies) > 0){
            $company = end($this->listOfCompanies);
            $id = $company->getIdCompany() + 1;
        }
        return $id;
    }

    public function modifyCompany(Company $modifiedCompany)
    {
        $this->RetrieveData();

        foreach ($this->listOfCompanies as $company) {
            if ($company->getIdCompany() == $modifiedCompany->getIdCompany()){
                $key = array_search($company, $this->listOfCompanies);
                $this->listOfCompanies[$key] = $modifiedCompany;

            }
        }
        
        $this->saveData();
    }
}
