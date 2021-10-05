<?php

namespace DAO;

use Models\Student as Student;
use DAO\IStudentDAO as IStudentDAO;

class StudentDAO implements IStudentDAO
{
    private $listOfStudents = array();

    public function __construct()
    {

    }

    private function retrieveData()
    {
        $this->listOfStudents = array();

        $options = array(
            'http' => array(
              'method'=>"GET",
              'header'=>"x-api-key: " . API_KEY)
       );

        $context = stream_context_create($options);

        $response = file_get_contents(API_URL .'Student', false, $context);

        $arrayToDecode = json_decode($response, true);
        
        foreach ($arrayToDecode as $values) {
            $student = new Student();
            $student->setStudentId($values['studentId']);
            $student->setCareerId($values['careerId']);
            $student->setFirstName($values['firstName']);
            $student->setLastName(($values['lastName']));
            $student->setDni($values['dni']);
            $student->setFileNumber($values['fileNumber']);
            $student->setGender($values['gender']);
            $student->setBirthDate($values['birthDate']);
            $student->setEmail($values['email']);
            $student->setPhoneNumber($values['phoneNumber']);
            $student->setActive($values['active']);
            var_dump($student);
            array_push($this->listOfStudents, $student);
        }
    
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->listOfStudents;
    }

    public function GetByStudentEmail($email)
    {
        $this->RetrieveData();

        foreach ($this->listOfStudents as $student) {
            if ($student->getEmail() == $email){
                return $student;
            }
        }

        return null;
    }
}
