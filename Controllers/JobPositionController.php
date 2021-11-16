<?php

namespace Controllers;

use DAO\JobPositionDAO as JobPositionDAO;
use \Exception as Exception;


class JobPositionController
{

    private $jobPositionDAO;

    public function __construct()
    {
        $this->jobPositionDAO = new JobPositionDAO();
    }

    public function Update()
    {
        try {
            $this->jobPositionDAO->updatePositionsFromAPI();
            require_once(VIEWS_PATH . "admin-firstpage.php");
        } catch (Exception $exception) {
            $DBerror = $exception->getMessage();
            HomeController::RedirectHome();
        }
    }
}
