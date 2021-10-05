<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function ShowListView()
        {
            $students = $this->studentDAO->GetAll();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowStudent($studentId)
        {
            $student = $this->studentDAO->GetByStudentId($studentId);

            require_once(VIEWS_PATH."student-show.php");
        }

    }    
?>