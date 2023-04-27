<?php

use model\class;
use model\class\Calendar;
use model\class\DbConnect;
use model\class\Event;

require_once dirname(__FILE__)."/../entity/Calendar.php";
require_once dirname(__FILE__)."/../entity/Event.php";
require_once dirname(__FILE__)."/../ORM/dbConnector.php";


function GetFullCalendars(string $token){
    $calendarsData = GetCalendars($token);
    foreach ($calendarsData as $calendarData){
        $calendarId = $calendarData['id'];
        $events = GetCalendarEvents($calendarId);
        $calendars[] = new Calendar($calendarData['id'], $calendarData['title'], $calendarData['description'], $events);
    }

    return $calendars;
}


/**
 * @param string $token
 * @throws Exception
 */
function GetCalendars(string $token): array
{
    $calendars = executeQuerySelect("
        SELECT calendar.id, calendar.title, calendar.description FROM calendar
        INNER JOIN user u on calendar.user_id = u.id
        WHERE u.token = '$token';");
    return $calendars;
}

function GetCalendarEvents(int $calendarId){
    $events = executeQuerySelect("
            SELECT event.id, event.title, event.description, event.start, event.end, event.place FROM event
            INNER JOIN calendar_has_event che on event.id = che.event_id
            INNER JOIN calendar c on che.calendar_id = c.id
            WHERE c.id = '$calendarId';");
    return $events;
}

