<?php

namespace Controllers;

use Models\User as User;
use Controllers\StudentController as StudentController;
use Controllers\UserController as UserController;
use Utils\Utils as Utils;
use Models\Student as Student;
use DAO\CareerDAO as CareerDAO;

class HomeController
{
    public function Index()
    {
        require_once(VIEWS_PATH . "index.php");
    }

    public function login($email, $password)
    {
        $userController = new UserController();
        $user = $userController->getUserByEmail($email);

        if($user != NULL) {
            if($password == $user->getPassword()) {

                if ($user->getUserTypeId() == 1) {
            
                    $_SESSION['admin'] = $user;
                    require_once(VIEWS_PATH . "admin-firstpage.php");
        
                } else if ($user->getUserTypeId() == 2) {
                    $studentController = new StudentController();
                    $student = new Student();
                    $student = $studentController->getByEmail($email);
        
                    if ($student != null) {
                        if($student->getActive()){
                            $_SESSION['student'] = $user;
                            require_once(VIEWS_PATH . "student-firstpage.php");
                        } else {
                            $notActiveStudent = true;
                        require_once(VIEWS_PATH . "index.php");
                        }
                    } else {
                        $invalidEmail = true;
                        require_once(VIEWS_PATH . "index.php");
                    }
                } else if ($user->getUserTypeId() == 3){
                   $_SESSION['company'] = $user;
                   // require_once(VIEWS_PATH . "company-firstpage.php");
                }

            } else {
                $invalidPassword = true;
                require_once(VIEWS_PATH . "index.php");
            }
            
        } else {
            $invalidEmail = true;
            require_once(VIEWS_PATH . "index.php");
        }
    }

    public function SelectNav()
    {
        Utils::checkSession();
        if (isset($_SESSION['admin'])) {
            require_once(VIEWS_PATH . "nav.php");
        } else {
            $student = $_SESSION['student'];
            require_once(VIEWS_PATH . "navAlum.php");
        }
    }
    
    public function RedirectHome()
    {
        Utils::checkSession();

        if (isset($_SESSION['admin'])) {
            require_once(VIEWS_PATH . "admin-firstpage.php");
        } else {
            
            require_once(VIEWS_PATH . "student-firstpage.php");
        }
       
    }

    public function ShowCompanyRegister()
    {
        require_once(VIEWS_PATH . "company-user-registration.php");
    }

    public function ShowStudentRegister()
    {
        require_once(VIEWS_PATH . "student-user-registration.php");
    }

    public function Logout()
    {
        session_destroy();

        $this->Index();
    }
}
