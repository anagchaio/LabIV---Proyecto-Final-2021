<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobOfferDAO as IJobOfferDAO;
    use Models\JobOffer as JobOffer;    
    use DAO\Connection as Connection;
use Models\JobOfferForView;

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

        }

        public function GetList()
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT j.id_jobOffer, cp.company_name, j.jobOffer_description, p.jobPosition_description, 
                cr.career_description, j.limit_date, j.state, u.id_student
                FROM jobOffers j
                INNER JOIN companies cp on j.company_id = cp.id_company
                INNER JOIN users u on j.student_id = u.id_student
                INNER JOIN jobPositions p on j.jobPosition_id = p.id_jobPosition
                INNER JOIN careers cr on p.career_id = cr.id_career;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOfferforView = new JobOfferForView();
                    $jobOfferforView->setJobOfferId($row["id_jobOffer"]);
                    $jobOfferforView->setCompanyName($row["company_name"]);
                    $jobOfferforView->setJobOffer_description($row["jobOffer_description"]);
                    $jobOfferforView->setJobPosition_description($row["jobPosition_description"]);
                    $jobOfferforView->setCareer_description($row["career_description"]);
                    $jobOfferforView->setLimitDate($row["limit_date"]);
                    $jobOfferforView->setState($row["state"]);

                    array_push($jobOfferList, $jobOfferforView);
                }

                return $jobOfferList;
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
            }

        }
    }