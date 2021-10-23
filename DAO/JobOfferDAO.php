<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\JobOffer as JobOffer;    
    use DAO\Connection as Connection;

    class JobOfferDAO implements IJobOfferDAO
    {
        private $connection;
        private $tableName = "jobOffers";

        public function Add(JobOffer $jobOffer)
        {
            $response = NULL;
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobOfferId, description, limitDate, state, companyId, jobPositionId, userId) 
                VALUES (:jobOfferId, :description, :limitDate, :state, :companyId, :jobPositionId, :userId);";
                
                $parameters["jobOfferId"] = $jobOffer->getJobOfferId();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["limitDate"] = $jobOffer->getLimitDate();
                $parameters["state"] = $jobOffer->getState();
                $parameters["companyId"] = $jobOffer->getCompanyId();
                $parameters["jobPositionId"] = $jobOffer->getJobPositionId();
                $parameters["userId"] = $jobOffer->getUserId();

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
                $jobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["id_jobOffer"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setLimitDate($row["limit_date"]);
                    $jobOffer->setState($row["state"]);
                    $jobOffer->setCompanyId($row["company_id"]);
                    $jobOffer->setJobPositionId($row["job_position_id"]);
                    $jobOffer->setUserId($row["user_id"]);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
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