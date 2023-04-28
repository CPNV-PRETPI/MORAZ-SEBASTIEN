<?php

namespace test;

use Exception;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../model/service/calendarService.php';

class testCalendarService extends TestCase
{
    public function testGetFullCalendarSuccess()
    {
        $calendars = getFullCalendars("exemple_token");
        $this->assertNotNull($calendars);
    }

    public function testGetFullCalendarFail()
    {
        $this->expectException(Exception::class);
        getFullCalendars("exemple_token_fail");
    }

    public function testGetCalendarsSuccess()
    {
        $calendars = getCalendars("exemple_token");
        $this->assertNotNull($calendars);
    }

    public function testGetCalendarsFail()
    {
        $this->expectException(Exception::class);
        getCalendars("exemple_token_fail");
    }

    public function testGetCalendarEventsSuccess()
    {
        $events = getCalendarEvents(1);
        $this->assertNotNull($events);
    }

    public function testGetCalendarEventsFail()
    {
        $this->expectException(Exception::class);
        getCalendarEvents(999);
    }

}