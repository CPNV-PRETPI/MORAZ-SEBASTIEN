<?php

use model\class\User;

require_once "entity/User.php";

/**
 * @param string $email
 * @param string $password
 * @param string $name
 * @throws Exception
 */
function requestRegister(string $email, string $password, string $name): void
{
    #check if email is a valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        http_response_code(400);
        throw new Exception("Invalid email");
    }
    try {
        $user = new User(NULL, $email, $password);
        $user->register($name);
        echo json_encode($user->getUserData());
    } catch (Exception $e) {
        echo json_encode($e->getMessage());

    }

}

?>