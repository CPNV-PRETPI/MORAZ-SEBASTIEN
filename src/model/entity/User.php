<?php

namespace model\class;

class User
{
    #Public Parameter
    public string $email;
    public string $token;
    public string $name;

    /**
     * User constructor.
     * @param string $token
     * @param string $email
     * @param string $name
     */
    public function __construct(string $token, string $email, string $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @note Get User Data
     * @return array
     */
    public function getUser(): array
    {
        return array(
            "token" => $this->token,
            "email" => $this->email,
            "name" => $this->name
        );
    }
}