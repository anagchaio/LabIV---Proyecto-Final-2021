<?php

namespace Controllers;

use DAO\UserDAO;
use \Exception as Exception;

class UserController
{

    private $UserDAO;

    public function __construct()
    {
        $this->UserDAO = new UserDAO();
    }

    public function getUserByEmail($email)
    {
        try {
            $user = $this->UserDAO->getUserByEmail($email);
            return $user;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
