<?php

namespace Controllers;

use Controllers\StudentController as StudentController;
use Models\Student as Student;
use Models\User as User;
use DAO\UserDAO;

class UserController{

    private $UserDAO;

    public function __construct()
        {
            $this->UserDAO = new UserDAO();
        }

    public function Register($email, $password){
        $studentController = new StudentController();
        $student = new Student();
        $student = $studentController->getByEmail($email);

        if ($student != null) {
            
            if($this->UserDAO->getUserByEmail($email) == null){
                $newUser = new User();
                $newUser->setEmail($email);
                $newUser->setPassword($password);
                $newUser->setName($student->getFirstName());
                $newUser->setStudentId($student->getStudentId());
                $newUser->setUserTypeId(2);
        
                $this->UserDAO->Add($newUser);

                $succesfulRegistration = true;
                require_once(VIEWS_PATH . "index.php");
            } else {
                $registedEmail = true;
                require_once(VIEWS_PATH . "user-registration.php");
            }
            
        } else {
            $invalidEmail = true;
            require_once(VIEWS_PATH . "index.php");
        }
    }

    public function getUserByEmail($email){
        $user = $this->UserDAO->getUserByEmail($email);
        return $user;
    }

}