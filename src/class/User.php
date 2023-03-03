<?php

use class\DbConnect;

require "DbConnect.php";

class User
{
    public string $email;
    public string $password;
    private string|null $token;
    private DbConnect $conn;
    private array $calendar;
    private string $userName;


    /**
     * @throws Exception
     */
    public function __construct(string $token = NULL, string $email = NULL, string $password = NULL)
    {
        if ($token != NULL){
            $this->token = $token;
        }
        elseif ($email != NULL && $password != NULL){
            $this->email = $email;
            $this->password = $password;
        }else{
            throw new Exception("Invalid parameters");
        }



        $config = json_decode(file_get_contents('C:\Users\sebastien.moraz\MORAZ-SEBASTIEN\src\data\dbConfig.json'), true);
        $this->conn = new DbConnect($config["hostname"], $config["username"],$config["password"], $config["database"]);
    }




    public function login(): void
    {
        $hashed = hash('sha512', $this->password);
        $result = $this->conn->executeQuery("SELECT token,name FROM user WHERE email = '$this->email' AND password = '$hashed'");
        if ($result != null){
            foreach ($result as $value){
                $this->token = $value[0];
                $this->userName = $value[1];
            }
        }
        else{
            $this->token = null;
        }
    }


    public function getUserData(): null|array
    {
        if ($this->token != null){
            return array(
                "token" => $this->token,
                "email" => $this->email,
                "name" => $this->userName
            );
        }else{
            return null;
        }
    }




}



?>