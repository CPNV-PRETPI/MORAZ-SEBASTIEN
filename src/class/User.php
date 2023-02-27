<?php

use class\DbConnect;

class User
{
    private string $email;
    private string $password;
    private string $token;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;

        $this->token = $this->login();

    }

    private function login(): ?string
    {
        $hashed = hash('sha512', $this->password);
        $sql = new DbConnect();
        $result = $sql->executeQuery("SELECT token FROM user WHERE email = '$this->email' AND password = '$hashed'");
        if ($result[0][0] != null){
            return $result[0][0];
        }
        else{
            return null;
        }

    }

}

?>