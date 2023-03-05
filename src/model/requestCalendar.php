<?php

require "src/class/User.php";

/**
 * @param string $token
 * @return void
 * @throws Exception
 */
function requestCalendar(string $token): void
{
    try {
        $user = new User($token);
        echo json_encode($user->getCalendar());
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}

?>