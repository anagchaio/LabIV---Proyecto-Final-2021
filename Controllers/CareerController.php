<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use \Exception as Exception;

class CareerController
{

    private $careerDAO;

    public function __construct()
    {
        $this->careerDAO = new CareerDAO();
    }

    public function Update()
    {
        try {
            $this->careerDAO->updateCareersFromAPI();
            require_once(VIEWS_PATH . "admin-firstpage.php");
            
        } catch (Exception $exception) {
            $DBerror = $exception->getMessage();
            HomeController::RedirectHome();
        }
    }
}
