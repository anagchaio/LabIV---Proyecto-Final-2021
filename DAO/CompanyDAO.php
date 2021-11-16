<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use DAO\Connection as Connection;
use \Exception as Exception;

class CompanyDAO implements ICompanyDAO
{

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
            throw $exception;
        }
    }

    public function deleteBD($idCompany)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE id_company = :id_company;";

            $parameters["id_company"] = $idCompany;

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            throw $exception;
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
            throw $exception;
        }
    }

    public function GetByCompanyId($idCompany)
    {
        try {
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
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function GetByCompanyEmail($companyEmail)
    {
        try {
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
        } catch (Exception $exception) {
            throw $exception;
        }
    }





    public function modify(Company $company)
    {
        try {

            $query = "UPDATE " . $this->tableName . " SET company_name=:company_name, yearFoundantion=:yearFoundantion,
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
            throw $exception;
        }
    }
}
