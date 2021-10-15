<?php

namespace Controllers;

use Models\User as User;
use Controllers\StudentController as StudentController;
use Utils\Utils as Utils;
use Models\Student as Student;
use DAO\CareerDAO as CareerDAO;

class HomeController
{
    public function Index()
    {
        require_once(VIEWS_PATH . "index.php");
    }

    public function login($email)
    {

        if ($email == ADMIN_ACCESS) {
            $user = new User($email);
            $_SESSION['admin'] = $user;

            require_once(VIEWS_PATH . "admin-firstpage.php");
        } else {
            $studentController = new StudentController();
            $student = new Student();
            $student = $studentController->getByEmail($email);
            $careerDAO = new CareerDAO();
            $career = $careerDAO->getCareerStudent($student);


            if ($student != null) {
                $_SESSION['student'] = $student;
                require_once(VIEWS_PATH . "student-firstpage.php");
                require_once(VIEWS_PATH . "student-show.php");
                

            } else {
                $invalidEmail = true;
                require_once(VIEWS_PATH . "index.php");
            }
        }
    }

    public function SelectNav()
    {
        Utils::checkAdminSession();
        if (isset($_SESSION['admin'])) {
            require_once(VIEWS_PATH . "nav.php");
        } else {
            require_once(VIEWS_PATH . "navAlum.php");
        }
    }
    
    public function RedirectAdm()
    {
        Utils::checkAdminSession();
        if (isset($_SESSION['admin'])) {
            require_once(VIEWS_PATH . "admin-firstpage.php");
        } else {
            require_once(VIEWS_PATH . "student-firstpage.php");
        }
       
    }

    public function Logout()
    {
        session_destroy();

        $this->Index();
    }
}
