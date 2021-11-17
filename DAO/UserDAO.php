<?php

namespace DAO;

use \Exception as Exception;
use DAO\IUserDAO as IUserDAO;
use Models\User as User;
use DAO\Connection as Connection;

class UserDAO implements IUserDAO
{
    private $connection;
    private $tableName = "users";

    public function Add(User $user)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (email, password, name, id_student, id_company, id_userType) 
                VALUES (:email, :password, :name, :id_student, :id_company, :id_userType);";


            $parameters["email"] = $user->getEmail();
            $parameters["password"] = $user->getPassword();
            $parameters["name"] = $user->getName();
            $parameters["id_student"] = $user->getStudentId();
            $parameters["id_company"] = $user->getCompanyId();
            $parameters["id_userType"] = $user->getUserTypeId();


            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            throw $exception->getMessage();
        }
    }

    public function GetAll()
    {
        try {
            $userList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setUserId($row["id_user"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setName($row["name"]);
                $user->setStudentId($row["id_student"]);
                $user->setCompanyId($row["id_company"]);
                $user->setUserTypeId($row["id_userType"]);

                array_push($userList, $user);
            }
            return $userList;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getUserByEmail($email)
    {
        try {
            $userExist = NULL;
            $users = $this->GetAll();

            foreach ($users as $user) {
                if ($user->getEmail() == $email) {
                    $userExist = $user;
                }
            }
            return $userExist;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getUserById($userId)
    {
        try {

            $query = "SELECT * FROM " . $this->tableName .
                " WHERE id_user =:id_user";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new User();
                $user->setUserId($row["id_user"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setName($row["name"]);
                $user->setStudentId($row["id_student"]);
                $user->setCompanyId($row["id_company"]);
                $user->setUserTypeId($row["id_userType"]);
            }
            return $user;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    // NO anda mas. Modificar con nueva logica de inscripcion

    /*     public function Update(User $user, $jobOfferId)
    {
        try {

            $query = "UPDATE " . $this->tableName . " SET id_jobOffer=:id_jobOffer
            WHERE id_user = :id_user;";

            $parameters["id_user"] = $user->getUserId();
            $parameters["id_jobOffer"] = $jobOfferId;

            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {
            $response = $exception->getMessage();
        }
    } */
}
