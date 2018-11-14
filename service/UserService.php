<?php
include "../database/database.php";

class UserService
{
    private $connection;

    public function __construct()
    {
        $this->connection = getDatabaseConnection();
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    function signUp($first_name, $last_name,$email, $password)
    {
        if(!$this->validateEmail($email)){
            throw new Exception("Cette adresse e-mail est invalide!");
        }
        if ($this->userExists($email)){
            throw new Exception("Un compte avec cette adresse existe déjà!");
        }
        $this->createUser($first_name, $last_name,$email, $password);
    }

    private function createUser($first_name, $last_name,$email, $password): void
    {
        $sql = "INSERT INTO user (first_name,last_name,email,password) VALUES (?,?,?,sha1(?))";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param("ssss", $first_name, $last_name, $email, $password);
        $statement->execute();
    }

    private function userExists($email)
    {
        $selectUser = $this->connection->prepare("SELECT count(*) FROM user WHERE email = ?");
        $selectUser->bind_param("s", $email);
        $selectUser->execute();
        $result = $selectUser->get_result()->fetch_all();
        return $result[0][0] !== 0;
    }

    private function validateEmail($email){
        return true;
        //TODO
    }

    public function login($email, $password) {
        $selectUser = $this->connection->prepare("SELECT count(*) FROM user WHERE email = ? and password = sha1(?)");
        $selectUser->bind_param("ss", $email, $password);
        $selectUser->execute();
        $result = $selectUser->get_result()->fetch_all();
        return $result[0][0] !== 0;
    }


}