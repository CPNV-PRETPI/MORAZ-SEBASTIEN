<?php

use model\class;
use model\class\Calendar;
use model\class\DbConnect;
use model\class\Event;

require_once dirname(__FILE__)."/../entity/Calendar.php";
require_once dirname(__FILE__)."/../entity/Event.php";
require_once dirname(__FILE__)."/../ORM/DbConnect.php";

/**
 * @param string $token
 * @throws Exception
 */
function GetCalendars(string $token): array
{
    if ($token == NULL) {
        http_response_code(400);
        throw new Exception("Invalid parameters");
    }
    $config = json_decode(file_get_contents(dirname(__FILE__) . '/../../data/dbConfig.json'), true);
    $conn = new DbConnect($config["hostname"], $config["username"], $config["password"], $config["database"]);

    $ids = $conn->executeQuery("
    SELECT calendar.id FROM calendar
    INNER JOIN user on calendar.user_id = user.id WHERE user.token = '$token'
    ");
    if ($ids == null) {
        http_response_code(401);
        throw new Exception("Error while getting calendar");
    }
    foreach ($ids as $id) {
        $arrayCalendar = $conn->executeQuery("
        SELECT calendar.id, calendar.title, calendar.description FROM calendar
        where calendar.id = '$id';");
        $arrayEvents = $conn->executeQuery("
         SELECT event.id, event.title, event.description, event.start, event.end, event.place FROM event
            INNER JOIN calendar_has_event on event.id = calendar_has_event.event_id
            INNER JOIN calendar on calendar_has_event.calendar_id = calendar.id
            WHERE calendar.id = '$id'");
        $calendars[] = new Calendar($arrayCalendar[0][0], $arrayCalendar[0][1], $arrayCalendar[0][2], $arrayEvents);
    }


    return $calendars;

}

