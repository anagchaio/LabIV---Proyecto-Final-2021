<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICareerDAO as ICareerDAO;
use DAO\API_CareerDAO as API_CareerDAO;
use Models\Career as Career;
use DAO\Connection as Connection;

class CareerDAO implements ICareerDAO
{
    private $connection;
    private $tableName = "careers";

    public function Add(Career $career)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (id_career, career_description, active) 
                VALUES (:id_career, :career_description, :active);";


            $parameters["id_career"] = $career->getCareerId();
            $parameters["career_description"] = $career->getDescription();
            $parameters["active"] = $career->getActive();

            $this->connection = Connection::GetInstance();
            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function GetAll()
    {
        try {
            $careerList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $career = new Career();
                $career->setCareerId($row["id_career"]);
                $career->setDescription($row["career_description"]);
                $career->setActive($row["active"]);

                array_push($careerList, $career);
            }
            return $careerList;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getCareerById($idCareer)
    {
        try {
            $foundCareer = NULL;
            $careers = $this->GetAll();
            foreach ($careers as $career) {
                if ($career->getCareerId() == $idCareer) {

                    $foundCareer = $career;
                }
            }
            return $foundCareer;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function Update(Career $career)
    {
        try {

            $query = "UPDATE " . $this->tableName . " SET career_description=:career_description, active=:active
            WHERE id_career = :id_career;";

            $parameters["id_career"] = $career->getCareerId();
            $parameters["career_description"] = $career->getDescription();
            $parameters["active"] = $career->getActive();

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            throw $exception;
        }
    }



    public function updateCareersFromAPI()
    {
        try {
            $API_CareerDAO = new API_CareerDAO();
            $careersFromAPI = $API_CareerDAO->GetAll();

            foreach ($careersFromAPI as $APICareer) {
                if ($this->getCareerById($APICareer->getCareerId()) != null) {
                    $this->Update($APICareer);
                } else {
                    $this->Add($APICareer);
                }
            }
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function GetAllActive()
    {
        try {
            $careers = $this->GetAll();
            $activeCareers = array();

            foreach ($careers as $career) {
                if ($career->getActive() == 1) {
                    array_push($activeCareers, $career);
                }
            }
            return $activeCareers;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
