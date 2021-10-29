<?php

namespace DAO;

use Models\JobPosition as JobPosition;
use DAO\IJobPositionDAO as IJobPositionDAO;

class API_JobPositionDAO implements IJobPositionDAO
{
    private $ListOfJobPosition = array();

    public function __construct()
    {

    }

    private function retrieveData()
    {
        $this->ListOfJobPosition = array();

        $options = array(
            'http' => array(
              'method'=>"GET",
              'header'=>"x-api-key: " . API_KEY)
       );

        $context = stream_context_create($options);

        $response = file_get_contents(API_URL .'JobPosition', false, $context);

        $arrayToDecode = json_decode($response, true);
        
        foreach ($arrayToDecode as $values) {
            $jobPosition = new JobPosition();
            $jobPosition->getJobPositionId($values['jobPositionId']);
            $jobPosition->setCareerId($values['careerId']);
            $jobPosition->setDescription($values['description']);
          
            array_push($this->ListOfJobPosition, $jobPosition);
        }
    
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->ListOfJobPosition;
    }

    public function GetByJobPositionId($jobPositionId)
    {
        $this->RetrieveData();

        foreach ($this->ListOfJobPosition as $jobPosition) {
            if ($jobPosition->getJobPositionId() == $jobPositionId){
                return $jobPosition;
            }
        }

        return null;
    }

}
