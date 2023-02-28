<?php

require "src/class/User.php";

function requestToken(string $email, string $password): void
{
    $user = new User($email, $password);
    $user->loadToken();
    if ($user->getToken() != null){
        echo $user->getToken();
    }
    else{
        echo "null";

    }
}

?>