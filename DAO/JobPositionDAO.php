<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\JobPosition as JobPosition;    
    use DAO\Connection as Connection;
use Models\JobOffer;

class JobPositionDAO implements IJobPositionDAO
    {
        private $connection;
        private $tableName = "careers";

        public function Add(JobPosition $jobPosition)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_jobPosition, id_career, description) 
                VALUES (:id_jobPosition, :id_career, :description);";
                
                $parameters["id_jobPosition"] = $jobPosition->getJobPositionId();
                $parameters["id_career"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
            }
        }

        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($row["id_jobPosition"]);
                    $jobPosition->setCareerId($row["id_career"]);
                    $jobPosition->setDescription($row["description"]);
                    
                    array_push($jobPositionList, $jobPosition);
                }
                return $jobPositionList;
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
            }
            
        }

    }