<?php

    namespace DAO;

    use Models\Career as Career;
    use DAO\ICareerDAO as ICareerDAO;

    class API_CareerDAO implements ICareerDAO{

        private $careerList = array();

        public function __construct(){
            
        }


        public function GetAll(){

            $this->RetrieveData();
            return $this->careerList;

        }

        private function RetrieveData(){
         
            $this->careerList = array();

            $options = array(
                'http' => array(
                'method'=>"GET",
                'header'=>"x-api-key: " . API_KEY)
            );

            $context = stream_context_create($options);

            $response = file_get_contents(API_URL .'Career', false, $context);

            $arrayToDecode = json_decode($response, true);
          
          foreach($arrayToDecode as $valuesArray){
            $career = new Career();
            $career->setCareerId($valuesArray['careerId']);
            $career->setDescription($valuesArray['description']);
            $career->setActive($valuesArray['active']);

            array_push($this->careerList, $career);

          }

        }

        public function GetAllActive(){
            /* $this->RetrieveData();
            return array_filter(
                $this->careerList,
                fn($activeCareer) => $activeCareer->getActive() === true
             ); */

        }

        public function GetCareerById($careerId){
            $this->RetrieveData();

            foreach ($this->careerList as $career) {
                if ($career->getCareerId() == $careerId){
                    return $career;
                }
            }
            return null;
    }

    public function getCareerStudent($student){
        $this->RetrieveData();
            foreach($this->careerList as $career){
                if($student->getCareerId() == $career->getCareerId())
                return $career;
            }
        
    }

    }




?> 