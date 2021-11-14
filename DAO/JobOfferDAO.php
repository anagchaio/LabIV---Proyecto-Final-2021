<?php

namespace DAO;

use \Exception as Exception;
use DAO\IJobOfferDAO as IJobOfferDAO;
use Models\JobOffer as JobOffer;
use DAO\Connection as Connection;
use Models\Student;

class JobOfferDAO implements IJobOfferDAO
{
    private $connection;
    private $tableName = "jobOffers";
    private $tableStudentXjobOffer = "studentXjobOffer";

    public function Add(JobOffer $jobOffer)
    {
        $response = NULL;
        try {
            $query = "INSERT INTO " . $this->tableName . " (jobOffer_description, limit_date, state, company_id, jobPosition_id, flyer) 
                VALUES (:jobOffer_description, :limit_date, :state, :company_id, :jobPosition_id, :flyer);";

            $parameters["jobOffer_description"] = $jobOffer->getJobOffer_description();
            $parameters["limit_date"] = $jobOffer->getLimitDate();
            $parameters["state"] = $jobOffer->getState();
            $parameters["company_id"] = $jobOffer->getCompanyId();
            $parameters["jobPosition_id"] = $jobOffer->getJobPositionId();
            $parameters["flyer"] = $jobOffer->getFlyer();

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            $response = $exception->getMessage();            
        }
    }

    public function deleteJobOfferById($jobOfferId)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE id_jobOffer = :id_jobOffer;";

            $parameters["id_jobOffer"] = $jobOfferId;

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function GetAll()
    {
        try {
            $jobOfferList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobOffer = new JobOffer();
                $jobOffer->setJobOfferId($row["id_jobOffer"]);
                $jobOffer->setDescription($row["jobOffer_description"]);
                $jobOffer->setLimitDate($row["limit_date"]);
                $jobOffer->setState($row["state"]);
                $jobOffer->setCompanyId($row["company_id"]);
                $jobOffer->setJobPositionId($row["job_position_id"]);
                $jobOffer->setUserId($row["user_id"]);
                $jobOffer->setStudentList($this->GetStudentsByJobOffer($row["id_jobOffer"]));

                array_push($jobOfferList, $jobOffer);
            }

            return $jobOfferList;
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function GetList()
    {
        try {
            $jobOfferList = array();

            $query = "SELECT j.id_jobOffer, cp.company_name, j.jobOffer_description, p.jobPosition_description, 
                cr.career_description, j.limit_date, j.state, j.flyer
                FROM joboffers j
                INNER JOIN companies cp on j.company_id = cp.id_company
                INNER JOIN jobpositions p on j.jobPosition_id = p.id_jobPosition
                INNER JOIN careers cr on p.career_id = cr.id_career;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobOffer = new JobOffer();
                $jobOffer->setJobOfferId($row["id_jobOffer"]);
                $jobOffer->setCompany_name($row["company_name"]);
                $jobOffer->setJobOffer_description($row["jobOffer_description"]);
                $jobOffer->setJobPosition_description($row["jobPosition_description"]);
                $jobOffer->setCareer_description($row["career_description"]);
                $jobOffer->setLimitDate($row["limit_date"]);
                $jobOffer->setState($row["state"]);
                $jobOffer->setFlyer($row["flyer"]);
                $jobOffer->setStudentList($this->GetStudentsByJobOffer($row["id_jobOffer"]));

                array_push($jobOfferList, $jobOffer);
            }
            return $jobOfferList;
        } catch (Exception $exception) {
            $response = $exception->getMessage();
            echo $response;
        }
    }



    public function GetJobOffer($jobOfferId)
    {
        try {

            $query = "SELECT j.id_jobOffer, j.company_id,  cp.company_name, j.jobOffer_description, j.limit_date, 
                j.state, j.jobPosition_id, p.jobPosition_description, cr.career_description, j.flyer
                FROM joboffers j
                INNER JOIN companies cp on j.company_id = cp.id_company
                INNER JOIN jobpositions p on j.jobPosition_id = p.id_jobPosition
                INNER JOIN careers cr on p.career_id = cr.id_career
                WHERE j.id_jobOffer = " . $jobOfferId . ";";



            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
                $jobOffer->setFlyer($row["flyer"]);
                $jobOffer->setStudentList($this->GetStudentsByJobOffer($row["id_jobOffer"]));
            }
            
            return $jobOffer;
        } catch (Exception $exception) {
            $response = $exception->getMessage();
            echo $response;
        }
    }

    protected function mapJobOffer($value){
        $value=is_array($value) ? $value: array();
        
        $result= array_map(function ($row){
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

            return $jobOffer;
        },$value);

        return count($result)>1 ? $result: $result["0"];
    }

    public function modify(JobOffer $jobOffer)
    {
        try {

            $query = "UPDATE " . $this->tableName . " SET jobOffer_description=:jobOffer_description, limit_date=:limit_date,
                company_id=:company_id, jobPosition_id=:jobPosition_id, flyer=:flyer
                WHERE id_jobOffer = :id_jobOffer;";

            $parameters["id_jobOffer"] = $jobOffer->getJobOfferId();
            $parameters["jobOffer_description"] = $jobOffer->getJobOffer_description();
            $parameters["limit_date"] = $jobOffer->getLimitDate();
            $parameters["company_id"] = $jobOffer->getCompanyId();
            $parameters["jobPosition_id"] = $jobOffer->getJobPositionId();
            $parameters["flyer"] = $jobOffer->getFlyer();

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function GetListByCareer($CareerId)
    {
        try {
            $jobOfferList = array();
            $query = "SELECT j.id_jobOffer, j.company_id,  cp.company_name, j.jobOffer_description, j.limit_date, 
                j.state, j.jobPosition_id, j.flyer, p.jobPosition_description, cr.career_description
                FROM joboffers j
                INNER JOIN companies cp on j.company_id = cp.id_company
                INNER JOIN jobpositions p on j.jobPosition_id = p.id_jobPosition
                INNER JOIN careers cr on p.career_id = cr.id_career
                WHERE p.career_id = ". $CareerId." AND j.state ='Opened';";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
                $jobOffer->setFlyer($row["flyer"]);
                $jobOffer->setStudentList($this->GetStudentsByJobOffer($row["id_jobOffer"]));

                array_push($jobOfferList, $jobOffer);
            }

            return $jobOfferList;
        } catch (Exception $exception) {
            $response = $exception->getMessage();
            echo $response;
        }
    }


    

    public function GetListByCompanyId($companyId)
    {
        try {
            $jobOfferList = array();
            $query = "SELECT j.id_jobOffer, j.company_id,  cp.company_name, j.jobOffer_description, j.limit_date, 
                j.state, j.jobPosition_id, j.flyer, p.jobPosition_description, cr.career_description
                FROM joboffers j
                INNER JOIN companies cp on j.company_id = cp.id_company
                INNER JOIN jobpositions p on j.jobPosition_id = p.id_jobPosition
                INNER JOIN careers cr on p.career_id = cr.id_career
                WHERE cp.id_company = ". $companyId.";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
                $jobOffer->setFlyer($row["flyer"]);
                $jobOffer->setStudentList($this->GetStudentsByJobOffer($row["id_jobOffer"]));

                array_push($jobOfferList, $jobOffer);
            }
            
            return $jobOfferList;

        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function AddStudentToJobOffer($jobOfferId, $studentId){
        try {

            $query = "INSERT INTO ". $this->tableStudentXjobOffer ." (student_id, id_jobOffer) 
            VALUES (:student_id, :id_jobOffer)";

            $parameters["id_jobOffer"] = $jobOfferId;
            $parameters["student_id"] = $studentId;

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
            
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function isStudentInJobOffer($jobOfferId, $studentId){
        try {
            $student = array();
            $query = "SELECT student_id
                FROM ". $this->tableStudentXjobOffer ."            
                WHERE id_jobOffer = " . $jobOfferId . " AND student_id =". $studentId .";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $student = new Student();
                $student->setStudentId($row["student_id"]);                
            }
            
            return $student;

        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }

    public function GetStudentsByJobOffer($jobOfferId)
    {
        try {
            $studentList = array();
            $query = "SELECT student_id
                FROM ". $this->tableStudentXjobOffer ."            
                WHERE id_jobOffer = " . $jobOfferId . ";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $student = new Student();
                $student->setStudentId($row["student_id"]);

                array_push($studentList, $student);
            }
            
            return $studentList;

        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    }
}