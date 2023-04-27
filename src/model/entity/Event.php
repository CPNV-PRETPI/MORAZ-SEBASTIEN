<?php

namespace model\class;

class Event
{
    // Attributes id, title, description, start, end, place
    public int $id;
    public string $title;
    public string $description;
    public string $start;
    public string $end;
    public string $place;

    public function __construct(int $id, string $title, string $description, string $start, string $end, string $place)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->start = $start;
        $this->end = $end;
        $this->place = $place;
    }

    public function getEvent(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start,
            'end' => $this->end,
            'place' => $this->place
        ];
    }



}