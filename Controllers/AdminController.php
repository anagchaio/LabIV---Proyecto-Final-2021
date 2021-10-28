<?php

namespace Controllers;
use DAO\UserDAO;

class AdminController{

    private $UserDAO;

    public function __construct()
        {
            $this->UserDAO = new UserDAO();
        }

    public function getUserByEmail($email){
        $user = $this->UserDAO->getUserByEmail($email);
        return $user;
    }

}