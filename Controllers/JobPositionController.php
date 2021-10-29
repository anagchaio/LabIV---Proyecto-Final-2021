<?php

namespace Controllers;

use DAO\JobPositionDAO as JobPositionDAO;

class JobPositionController
{

    private $jobPositionDAO;

    public function __construct()
    {
        $this->jobPositionDAO = new JobPositionDAO();
    }

    public function Update(){

        $this->jobPositionDAO->updatePositionsFromAPI();

        require_once(VIEWS_PATH . "admin-firstpage.php");

    }
}