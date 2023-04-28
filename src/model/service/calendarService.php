<?php

use model\class\Calendar;



require_once dirname(__FILE__)."/../entity/Calendar.php";
require_once dirname(__FILE__)."/../entity/Event.php";
require_once dirname(__FILE__)."/../ORM/dbConnector.php";


function getFullCalendars(string $token): array
{
    $calendarsData = getCalendars($token);
    foreach ($calendarsData as $calendarData){
        $calendarId = $calendarData['id'];
        $events = getCalendarEvents($calendarId);
        $calendars[] = new Calendar($calendarData['id'], $calendarData['title'], $calendarData['description'], $events);
    }

    return $calendars;
}

function checkTokenExist(string $token): void
{
    $result = executeQuerySelect("SELECT * FROM user WHERE token = '$token';");
    if ( empty($result) ){
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}

/**
 * @param string $token
 * @throws Exception
 */
function getCalendars(string $token): array
{
    checkTokenExist($token);
    $calendars = executeQuerySelect("
        SELECT calendar.id, calendar.title, calendar.description FROM calendar
        INNER JOIN user u on calendar.user_id = u.id
        WHERE u.token = '$token';");
    return $calendars;
}

function getCalendarEvents(int $calendarId): array
{
    checkCalendarExist($calendarId);
    try {
        $events = executeQuerySelect("
                SELECT event.id, event.title, event.description, event.start, event.end, event.place FROM event
                INNER JOIN calendar_has_event che on event.id = che.event_id
                INNER JOIN calendar c on che.calendar_id = c.id
                WHERE c.id = '$calendarId';");
        return $events;
    }catch (Exception $e){
        throw new Exception("Error while getting events from calendar");
    }
}

function checkCalendarExist(int $calendarId): void
{
    $result = executeQuerySelect("SELECT * FROM calendar WHERE id = '$calendarId';");
    if ( empty($result) ){
        http_response_code(404);
        throw new Exception("Calendar not found");
    }
}

