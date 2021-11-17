<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use \Exception as Exception;
use Utils\Utils as Utils;

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
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }
}
