<?php
    namespace DAO;

    use Models\Student as Student;

    interface IStudentDAO
    {
        function GetAll();
        function GetByStudentEmail($email);
    }
?>