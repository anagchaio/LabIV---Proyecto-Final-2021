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
            Utils::checkSession();
            $students = $this->studentDAO->GetAll();
            $careers = $this->careerDAO->GetAll();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowStudent($studentId)
        {
            Utils::checkSession();
            $student = $this->studentDAO->GetByStudentId($studentId);
            foreach($this->careerDAO->GetAll() as $career){
                if($career->getCareerId() == $student->getCareerId()){
                     $careerName = $career->getDescription();
                }
           }
            require_once(VIEWS_PATH."student-show.php");
        }

        public function getByEmail($email){
            $student = $this->studentDAO->GetByStudentEmail($email);
            return $student;
        }

    }    
?>