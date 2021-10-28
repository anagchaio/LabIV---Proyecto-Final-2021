<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICareerDAO as ICareerDAO;
use Models\Career as Career;
use DAO\Connection as Connection;

class CareerDAO implements ICareerDAO
{
    private $connection;
    private $tableName = "careers";

    public function Add(Career $career)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (id_career, description, active) 
                VALUES (:id_career, :description, :active);";


            $parameters["id_career"] = $career->getCareerId();
            $parameters["description"] = $career->getDescription();
            $parameters["active"] = $career->getActive();

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function GetAll()
    {
        try {
            $userList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $career = new Career();
                $career->setCareerId($row["id_career"]);
                $career->setDescription($row["description"]);
                $career->setActive($row["active"]);

                array_push($careerList, $career);
            }
            return $careerList;
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function GetAllActive()
    {
    }

    public function getCareerById($idCareer)
    {
        $careers = $this->GetAll();
        foreach ($careers as $career) {
            if ($career->getCareerId() == $idCareer) {

                return $career->getDescription();
            }
        }
    }
}
