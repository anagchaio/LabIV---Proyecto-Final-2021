<?php

namespace Controllers;

use Models\JobOffer as JobOffer;
use Controllers\UserController as UserController;
use Utils\Utils as Utils;
use DAO\JobOfferDAO as JobOfferDAO;

class JobOfferController {
    private $jobOfferDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAO();
    }

    //method, view
    public function add() {

    }

    //method, DAO, view
    public function update() {

    }

    //method, DAO, view
    public function delete() {

    }

    public function ShowListView() {
        Utils::checkSession();
        $jobOffers = $this->jobOfferDAO->GetList();
        require_once(VIEWS_PATH . "jobOffer-list.php");
    }

}