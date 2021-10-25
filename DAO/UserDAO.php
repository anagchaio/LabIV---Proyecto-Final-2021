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
            $response = NULL;
            try
            {
                $query = "INSERT INTO ".$this->tableName." (userId, email, password, name, studentId, userTypeId) 
                VALUES (:userId, :email, :password, :name, :studentId, :userTypeId);";
                
                $parameters["userId"] = $user->getUserId();
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();
                $parameters["name"] = $user->getName();
                $parameters["studentId"] = $user->getStudentId();
                $parameters["userTypeId"] = $user->getUserTypeId();

                $this->connection = Connection::GetInstance();

                $response = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
            }
            finally
            {
                return $response;
            }
        }

        public function GetAll()
        {
            $response = NULL;
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setUserId($row["id_user"]);
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setName($row["name"]);
                    $user->setStudentId($row["id_student"]);
                    $user->setUserTypeId($row["id_userType"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $exception)
            {
                $response = $exception->getMessage();
            }
            finally
            {
                return $response;
            }
            
        }

        public function getUserByEmail($email){
            $userExist = NULL;
            $users = $this->GetAll();
            foreach($users as $user){
                if($user->getEmail() == $email){
                    $userExist = $user;
                }
            }
            return $userExist;
        }
    }