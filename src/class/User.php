<?php

use class\DbConnect;

require_once "DbConnect.php";

class User
{
    #Public Parameter
    public string|null $email = NULL;
    public string $userName;

    #Private Parameter
    private string|null $password = NULL;
    private string|null $token = NULL;
    private DbConnect $conn;


    /**
     * User constructor.
     * @param string|null $token
     * @param string|null $email
     * @param string|null $password
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
            http_response_code(400);
            throw new Exception("Invalid parameters");

        }

        $config = json_decode(file_get_contents('P:\MORAZ-SEBASTIEN\src\data\dbConfig.json'), true);
        $this->conn = new DbConnect($config["hostname"], $config["username"],$config["password"], $config["database"]);
    }

    /**
     * @note Get User Data
     * @throws Exception
     */
    public function login(): void
    {
        if ($this->token != NULL){
            $result = $this->conn->executeQuery("SELECT email,name FROM user WHERE token = '$this->token'");
            if ($result != null){
                foreach ($result as $value){
                    $this->email = $value[0];
                    $this->userName = $value[1];
                }
            }
            else{
                http_response_code(401);
                throw new Exception("Invalid token");
            }

        }elseif ($this->email != NULL && $this->password != NULL){
            $hashed = hash('sha512', $this->password);
            $result = $this->conn->executeQuery("SELECT token,name FROM user WHERE email = '$this->email' AND password = '$hashed'");
            if ($result != null){
                foreach ($result as $value){
                    $this->token = $value[0];
                    $this->userName = $value[1];
                }
            }
            else{
                http_response_code(401);
                throw new Exception("Invalid email or password");
            }
        }
    }

    /**
     * @note Register a new user in Database
     * @param string $name
     * @throws Exception
     */
    public function register(string $name): void
    {
        if ($this->conn->executeQuery("SELECT email FROM user WHERE email = '$this->email'") != null){
            http_response_code(400);
            throw new Exception("Email already used");
        }
        $hashed = hash('sha512', $this->password);

        do{
            $this->token = bin2hex(random_bytes(32));
        }while ($this->conn->executeQuery("SELECT token FROM user WHERE token = '$this->token'") != null);

        $result = $this->conn->executeQuery("INSERT INTO user (email, name, password, token) VALUES ('$this->email', '$name', '$hashed', '$this->token')");
        if ($result != null){
            $this->token = null;
        }else{
            $this->userName = $name;
        }
    }

    /**
     * @note Get User Data
     * @return array|null
     */
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
