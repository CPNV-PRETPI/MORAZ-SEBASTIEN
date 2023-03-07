<?php

require "src/class/User.php";


/**
 * @param string|NULL $token
 * @param string|null $email
 * @param string|null $password
 * @return void
 * @throws Exception
 */
function requestLoginWithEmail(string $email, string $password): void
{

    try {
        $user = new User(NULL, $email, $password);
        $user->login();
        echo json_encode($user->getUserData());
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}

function requestLoginWithToken(string $token): void
{
    try {
        $user = new User($token);
        $user->login();
        echo json_encode($user->getUserData());
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}

?>