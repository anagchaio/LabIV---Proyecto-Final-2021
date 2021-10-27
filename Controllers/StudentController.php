<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use DAO\API_CareerDAO as API_CareerDAO;
    use Utils\Utils as Utils;

class StudentController
    {
        private $studentDAO;
        private $APIcareerDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->APIcareerDAO = new API_CareerDAO();
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
?>