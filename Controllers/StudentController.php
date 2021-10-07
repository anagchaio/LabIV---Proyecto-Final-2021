<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Utils\Utils as Utils;

class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function ShowListView()
        {
            Utils::checkSession();
            $students = $this->studentDAO->GetAll();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowStudent($studentId)
        {
            Utils::checkSession();
            $student = $this->studentDAO->GetByStudentId($studentId);
            require_once(VIEWS_PATH."student-show.php");
        }

        public function getByEmail($email){
            $student = $this->studentDAO->GetByStudentEmail($email);
            return $student;
        }

    }    
?>