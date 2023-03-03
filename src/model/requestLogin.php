<?php

require "src/class/User.php";

function requestLogin(string $token = NULL, string|null $email = NULL, string|null $password = NULL): void
{
    if ($token != NULL){
        $user = new User($token);
        echo json_encode($user->getUserData());
    }elseif ($email != NULL && $password != NULL) {
        $user = new User(NULL, $email, $password);
        $user->login();
        echo json_encode($user->getUserData());
    }else{
        echo json_encode("invalid parameters");
    }
}

?>