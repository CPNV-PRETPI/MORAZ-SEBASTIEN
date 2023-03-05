<?php

require "src/class/User.php";


/**
 * @param string|NULL $token
 * @param string|null $email
 * @param string|null $password
 * @return void
 * @throws Exception
 */
function requestLogin(string $token = NULL, string|null $email = NULL, string|null $password = NULL): void
{
    if ($token != NULL){
        try {
            $user = new User($token);
            echo json_encode($user->getUserData());
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }elseif ($email != NULL && $password != NULL) {
        try {
            $user = new User(NULL, $email, $password);
            $user->login();
            echo json_encode($user->getUserData());
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }else{
        echo json_encode("invalid parameters");
    }
}

?>