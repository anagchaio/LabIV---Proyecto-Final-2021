<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;

class CareerController
{

    private $careerDAO;

    public function __construct()
    {
        $this->careerDAO = new CareerDAO();
    }

    public function Update(){

        $this->careerDAO->updateCareersFromAPI();

        require_once(VIEWS_PATH . "admin-firstpage.php");

    }
}
