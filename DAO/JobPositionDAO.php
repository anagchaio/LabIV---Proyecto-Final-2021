<?php

namespace DAO;

use \Exception as Exception;
use DAO\IJobPositionDAO as IJobPositionDAO;
use Models\JobPosition as JobPosition;
use DAO\Connection as Connection;
use DAO\API_JobPositionDAO as API_JobPositionDAO;
use DAO\API_CareerDAO as API_CareerDAO;

class JobPositionDAO implements IJobPositionDAO
{
    private $connection;
    private $tableName = "jobpositions";

    public function Add(JobPosition $jobPosition)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (id_jobPosition, jobPosition_description, career_id) 
                VALUES (:id_jobPosition, :jobPosition_description, :career_id);";

            $parameters["id_jobPosition"] = $jobPosition->getJobPositionId();
            $parameters["jobPosition_description"] = $jobPosition->getDescription();
            $parameters["career_id"] = $jobPosition->getCareerId();

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function GetAll()
    {
        try {
            $jobPositionList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobPosition = new JobPosition();
                $jobPosition->setJobPositionId($row["id_jobPosition"]);
                $jobPosition->setDescription($row["jobPosition_description"]);
                $jobPosition->setCareerId($row["career_id"]);

                array_push($jobPositionList, $jobPosition);
            }
            return $jobPositionList;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
    public function Update(JobPosition $jobPosition)
    {
        try {

            $query = "UPDATE " . $this->tableName . " 
            SET jobPosition_description=:jobPosition_description, career_id=:career_id
            WHERE id_jobPosition = :id_jobPosition;";

            $parameters["id_jobPosition"] = $jobPosition->getJobPositionId();
            $parameters["jobPosition_description"] = $jobPosition->getDescription();
            $parameters["career_id"] = $jobPosition->getCareerId();

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
    public function getPositionById($idJobPosition)
    {
        try {
            $foundPosition = NULL;
            $jobPositions = $this->GetAll();

            foreach ($jobPositions as $jobPosition) {
                if ($jobPosition->getJobPositionId() == $idJobPosition) {

                    $foundPosition = $jobPosition;
                }
            }
            return $foundPosition;
        } catch (Exception $exception) {
            throw $exception;
        }
    }


    public function updatePositionsFromAPI()
    {
        try {
            $API_jobPositionDAO = new API_JobPositionDAO();
            $positionsFromAPI = $API_jobPositionDAO->GetAll();

            foreach ($positionsFromAPI as $APIposition) {
                if ($this->getPositionById($APIposition->getJobPositionId()) != null) {
                    $this->Update($APIposition);
                } else {
                    $this->Add($APIposition);
                }
            }
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function GetAllActiveCareers()
    {
        try {
            $jobPositionList = array();

            $query = "SELECT id_jobPosition, jobPosition_description, career_id 
            FROM jobpositions p
            INNER JOIN careers cr on cr.id_career = p.career_id
            WHERE cr.active = true;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobPosition = new JobPosition();
                $jobPosition->setJobPositionId($row["id_jobPosition"]);
                $jobPosition->setDescription($row["jobPosition_description"]);
                $jobPosition->setCareerId($row["career_id"]);

                array_push($jobPositionList, $jobPosition);
            }
            return $jobPositionList;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
