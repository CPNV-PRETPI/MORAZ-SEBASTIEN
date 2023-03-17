<?php

use class\DbConnect;

require_once "DbConnect.php";

class Calendar
{
    private string $token;
    private DbConnect $conn;
    private array $calendar;


    public function __construct(string $token)
    {
        $this->token = $token;

        $config = json_decode(file_get_contents('P:\MORAZ-SEBASTIEN\src\data\dbConfig.json'), true);
        $this->conn = new DbConnect($config["hostname"], $config["username"],$config["password"], $config["database"]);
    }

    /**
     * @note Get all calendar of the user
     * @return array
     * @throws Exception
     */
    public function getCalendar(): array
    {
        if ($this->token == null){
            http_response_code(401);
            return array();
        }else{
            $result = $this->conn->executeQuery("
                SELECT c.id as calendar_id, c.title as calendar_title, c.description as calendar_description, e.id as event_id, e.title as event_title, e.description as event_description, e.start, e.end, e.place
                FROM user u
                JOIN calendar c ON u.id = c.user_id
                JOIN calendar_has_event che ON c.id = che.calendar_id
                JOIN event e ON che.event_id = e.id
                WHERE u.token = '".$this->token."'
                ORDER BY c.id, e.start;
            ");
            if ($result == null){
                http_response_code(401);
                throw new Exception("Error while getting calendar");
            }
            foreach ($result as $value){
                $this->calendar[$value[0]] = array(
                    "id" => $value[0],
                    "title" => $value[1],
                    "description" => $value[2],
                    "events" => array()
                );
            }
            foreach ($result as $value){
                $this->calendar[$value[0]]["events"][] = array(
                    "id" => $value[3],
                    "title" => $value[4],
                    "description" => $value[5],
                    "start" => $value[6],
                    "end" => $value[7],
                    "place" => $value[8]
                );
            }
            return $this->calendar;
        }
    }
}