<?php

require "src/class/Calendar.php";

/**
 * @param string $token
 * @return void
 * @throws Exception
 */
function requestCalendar(string $token): void
{
    try {
        $calendar = new Calendar($token);
        echo json_encode($calendar->getCalendar());
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}

?>