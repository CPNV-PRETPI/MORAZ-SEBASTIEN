<?php

use class\DbConnect;

require "DbConnect.php";

class User
{

    public string $email;
    public string $password;
    private string|null $token;



    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;

    }

    public function loadToken(): void
    {
        $config = json_decode(file_get_contents('C:\Users\sebastien.moraz\MORAZ-SEBASTIEN\src\data\dbConfig.json'), true);
        $sql = new DbConnect($config["hostname"], $config["username"],$config["password"], $config["database"]);

        $hashed = hash('sha512', $this->password);
        $result = $sql->executeQuery("SELECT token FROM user WHERE email = '$this->email' AND password = '$hashed'");
        if ($result != null){
            $this->token = $result[0][0];
        }
        else{
            $this->token = null;
        }
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}

?>