<?php

    namespace DAO;

    use Models\Career as Career;
    use DAO\ICareerDAO as ICareerDAO;

    class CareerDAO implements ICareerDAO{

        private $careerList = array();

        public function __construct(){
            
        }


        public function GetAll(){

            $this->RetrieveData();
            return $this->careerList;

        }

        public function Delete(Career $careerToDelete){

        }

        private function RetrieveData(){
          //curl - api 

          $ch = curl_init();

          $url = API_URL .'Career';

          //no me toma la constante de la key por eso la uso aca. 
          $header = array(
              'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
          );

          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
          $response = curl_exec($ch);

          $arrayToDecode = json_decode($response,true);

          foreach($arrayToDecode as $valuesArray){
            $career = new Career();
            $career->setCareerId($valuesArray['careerId']);
            $career->setDescription($valuesArray['description']);
            $career->setActive($valuesArray['active']);

            array_push($this->careerList, $career);

          }


        }

        public function GetAllActive(){

            $this->RetrieveData();
            return array_filter(
                $this->careerList,
                fn($activeCareer) => $activeCareer->getActive() === true
             );

        }

    }




?> 