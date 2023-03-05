<?php

require_once "src/class/User.php";

/**
 * @param string $email
 * @param string $password
 * @param string $name
 * @throws Exception
 */
function requestRegister(string $email, string $password, string $name): void
{

    try {
        $user = new User(NULL, $email, $password);
        $user->register($name);
        echo json_encode($user->getUserData());
    } catch (Exception $e) {
        echo json_encode($e->getMessage());

    }

}

?>