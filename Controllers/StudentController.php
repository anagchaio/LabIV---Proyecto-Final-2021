<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use DAO\API_CareerDAO as API_CareerDAO;
    use Models\Student as Student;
    use Models\User as User;
    use DAO\UserDAO;
    use Utils\Utils as Utils;

class StudentController
    {
        private $studentDAO;
        private $APIcareerDAO;
        private $UserDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->UserDAO = new UserDAO();
            $this->APIcareerDAO = new API_CareerDAO();
        }

        public function Register($email, $password){
            $studentController = new StudentController();
            $student = new Student();
            $student = $studentController->getByEmail($email);
    
            if ($student != null) {
                if($student->getActive()){
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
                }  else {
                    $invalidEmail = true;
                    require_once(VIEWS_PATH . "user-registration.php");
                }
            } else {
                $invalidEmail = true;
                require_once(VIEWS_PATH . "user-registration.php");
            }
        }

        public function ShowListView()
        {
            Utils::checkAdminSession();
            $students = $this->studentDAO->GetAll();
            $careers = $this->APIcareerDAO->GetAll();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowStudent($studentId)
        {
            Utils::checkSession();
            
            if(isset($_SESSION['admin']) || ($_SESSION['student']->getStudentId() == $studentId)) {
                $student = $this->studentDAO->GetByStudentId($studentId);
                $career = $this->APIcareerDAO->getCareerStudent($student);
    
                require_once(VIEWS_PATH."student-show.php");
            }  else {
                Utils::checkAdminSession();
            }
            
        }


        public function getByEmail($email){
            $student = $this->studentDAO->GetByStudentEmail($email);
            return $student;
        }

    }
