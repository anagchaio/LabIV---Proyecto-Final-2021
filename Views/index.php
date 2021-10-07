<?php
    require_once('nav.php');
    //API Student Test
    /* use DAO\StudentDAO as studentDAO;

    $studentDAO = new studentDAO();

    $students = $studentDAO->getAll();

    var_dump($students); */

    use DAO\CareerDAO as CareerDAO;

    $careerDao = new CareerDAO();

    $career = $careerDao->GetAll();

    var_dump($career);

?>