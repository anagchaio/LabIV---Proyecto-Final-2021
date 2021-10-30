<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;

class CompanyDAO implements ICompanyDAO
{
    private $listOfCompanies = array();
    private $fileName;

    private $connection;
    private $tableName = "companies";

    public function __construct()
    {
        $this->fileName = ROOT . "Data/companies.json";
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

    public function delete($companyId)
    {
        try
        {
            $comapanyToRemove = "DELETE FROM $this->tableName WHERE companyId = '$companyId'"; 
            $this->connection = Connection::GetInstance();
            $response= $this->connection->ExecuteNonQuery($comapanyToRemove);
        }
        catch(Exception $exception)
        {
            $response = $exception->getMessage();
        }
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
        try
            {

                $companyByEmail = "SELECT * FROM $this->tableName WHERE email = '$companyEmail'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($companyByEmail);
                
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
                }

                return $company;
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

    public function GetByCompanyId($idCompany)
    {
        try
            {

                $companyById = "SELECT * FROM $this->tableName WHERE idCompany = '$idCompany'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($companyById);
                
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
                }

                return $company;
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
        try {

                $companyModifyquery = "UPDATE" . $this->tableName . "
                SET company_name=:company_name, yearFoundantion=:yearFoundantion, city=:city,description=:description,email=:email,logo=:logo, phonenumber=:phonenumber
                WHERE companyId = :companyId;";

                $parameters["id_company"]=$modifiedCompany->getIdCompany();
                $parameters["company_name"]=$modifiedCompany->getName();
                $parameters["yearFoundantion"]=$modifiedCompany->getYearFoundantion();
                $parameters["city"]=$modifiedCompany->getCity();
                $parameters["description"]=$modifiedCompany->getDescription();
                $parameters["logo"]=$modifiedCompany->getLogo();
                $parameters["email"]=$modifiedCompany->getEmail();
                $parameters["phonenumber"]=$modifiedCompany->getPhoneNumber();

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($companyModifyquery, $parameters);
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }
}
