<?php

namespace Controllers;
use DAO\UserDAO;

class UserController{

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