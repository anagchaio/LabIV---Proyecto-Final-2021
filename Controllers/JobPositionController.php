<?php

namespace Controllers;

use DAO\JobPositionDAO as JobPositionDAO;
use \Exception as Exception;
use Utils\Utils as Utils;

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
            Utils::ShowDateBaseError($exception->getMessage());
        }
    }
}
