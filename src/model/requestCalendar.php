<?php

require "src/class/User.php";

/**
 * @throws Exception
 */
function requestCalendar(string $token): void
{
    $user = new User($token);
    echo json_encode($user->getCalendar());
}

?>