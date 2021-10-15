<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use DAO\CareerDAO as CareerDAO;
    use Utils\Utils as Utils;

class StudentController
    {
        private $studentDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function ShowListView()
        {
            Utils::checkAdminSession();
            $students = $this->studentDAO->GetAll();
            $careers = $this->careerDAO->GetAll();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowStudent($studentId)
        {
            Utils::checkSession();
            if($_SESSION['student']->getStudentId() == $studentId || isset($_SESSION['admin']) ) {
                $student = $this->studentDAO->GetByStudentId($studentId);
                $career = $this->careerDAO->getCareerStudent($student);
    
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