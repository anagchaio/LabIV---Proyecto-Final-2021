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
                $query = "INSERT INTO ".$this->tableName." (jobOffer_description, limit_date, state, company_id, jobPosition_id, student_id) 
                VALUES (:jobOffer_description, :limit_date, :state, :company_id, :jobPosition_id, :student_id);";
                
                $parameters["jobOffer_description"] = $jobOffer->getJobOffer_description();
                $parameters["limit_date"] = $jobOffer->getLimitDate();
                $parameters["state"] = $jobOffer->getState();
                $parameters["company_id"] = $jobOffer->getCompanyId();
                $parameters["jobPosition_id"] = $jobOffer->getJobPositionId();
                $parameters["student_id"] = $jobOffer->getUserId();

                $this->connection = Connection::GetInstance();

                return $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
                echo $response;
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
                    $jobOffer->setDescription($row["jobOffer_description"]);
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
                cr.career_description, j.limit_date, j.state, j.student_id
                FROM joboffers j
                INNER JOIN companies cp on j.company_id = cp.id_company
                INNER JOIN jobpositions p on j.jobPosition_id = p.id_jobPosition
                INNER JOIN careers cr on p.career_id = cr.id_career;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["id_jobOffer"]);
                    $jobOffer->setCompany_name($row["company_name"]);
                    $jobOffer->setJobOffer_description($row["jobOffer_description"]);
                    $jobOffer->setJobPosition_description($row["jobPosition_description"]);
                    $jobOffer->setCareer_description($row["career_description"]);
                    $jobOffer->setLimitDate($row["limit_date"]);
                    $jobOffer->setState($row["state"]);
                    $jobOffer->getStudentId($row["student_id"]);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
                echo $response;
            }

        }

        public function GetJobOffer($jobOfferId)
        {
            try
            {

                $query = "SELECT j.id_jobOffer, j.company_id,  cp.company_name, j.jobOffer_description, j.limit_date, 
                j.state, j.student_id, j.jobPosition_id, p.jobPosition_description, cr.career_description
                FROM joboffers j
                INNER JOIN companies cp on j.company_id = cp.id_company
                INNER JOIN jobpositions p on j.jobPosition_id = p.id_jobPosition
                INNER JOIN careers cr on p.career_id = cr.id_career
                WHERE j.id_jobOffer = ". $jobOfferId .";";



                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["id_jobOffer"]);
                    $jobOffer->setCompanyId($row["company_id"]);
                    $jobOffer->setCompany_name($row["company_name"]);
                    $jobOffer->setJobOffer_description($row["jobOffer_description"]);
                    $jobOffer->setJobPositionId($row["jobPosition_id"]);
                    $jobOffer->setJobPosition_description($row["jobPosition_description"]);
                    $jobOffer->setCareer_description($row["career_description"]);
                    $jobOffer->setLimitDate($row["limit_date"]);
                    $jobOffer->setState($row["state"]);
                    $jobOffer->getStudentId($row["student_id"]);

                }

                return $jobOffer;
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
                echo $response;
            }

        }
    }