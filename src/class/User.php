<?php

use class\DbConnect;

require "DbConnect.php";

class User
{
    #Public Parameter
    public string $email;
    public string $password;


    #Private Parameter
    private string|null $token;
    private DbConnect $conn;
    private array $calendar;
    private string $userName;


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
            throw new Exception("Invalid parameters");
        }



        $config = json_decode(file_get_contents('C:\Users\sebas\Desktop\MORAZ-SEBASTIEN\src\data\dbConfig.json'), true);
        $this->conn = new DbConnect($config["hostname"], $config["username"],$config["password"], $config["database"]);
    }



    /**
     * @note Get User Data
     */
    public function login(): void
    {
        if ($this->password == NULL || $this->email == NULL){
            throw new Exception("Parameters not set");
        }
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

    /**
     * @note Register a new user in Database
     * @param string $name
     * @throws Exception
     */
    public function register(string $name): void
    {
        if ($this->password == NULL || $this->email == NULL){
            throw new Exception("Parameters not set");
        }
        if ($this->conn->executeQuery("SELECT email FROM user WHERE email = '$this->email'") != null){
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

    /**
     * @note Get all calendar of the user
     * @return array
     */
    public function getCalendar(): array
    {
        if ($this->token == null){
            http_response_code(401);
            return array();
        }else{
            $result = $this->conn->executeQuery("
                SELECT c.id as calendar_id, c.title as calendar_title, c.description as calendar_description, e.id as event_id, e.title as event_title, e.description as event_description, e.start, e.end, e.place
                FROM user u
                JOIN calendar c ON u.id = c.user_id
                JOIN calendar_has_event che ON c.id = che.calendar_id
                JOIN event e ON che.event_id = e.id
                WHERE u.token = '".$this->token."'
                ORDER BY c.id, e.start;
            ");
            if ($result == null){
                return array();
            }
            foreach ($result as $value){
                $this->calendar[$value[0]] = array(
                    "id" => $value[0],
                    "title" => $value[1],
                    "description" => $value[2],
                    "events" => array()
                );
            }
            foreach ($result as $value){
                $this->calendar[$value[0]]["events"][] = array(
                    "id" => $value[3],
                    "title" => $value[4],
                    "description" => $value[5],
                    "start" => $value[6],
                    "end" => $value[7],
                    "place" => $value[8]
                );
            }
            return $this->calendar;

        }
    }


}



?>