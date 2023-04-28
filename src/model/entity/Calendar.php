<?php

namespace model\class;

require_once dirname(__FILE__)."/Event.php";

class Calendar
{
    public int $id;
    public string $title;
    public string $description;
    public array $events;

    public function __construct(int $id, string $title, string $description, array $events)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->events = $events;
    }

    public function getCalendar(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'events' => $this->events
        ];
    }
}