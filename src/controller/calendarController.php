<?php

require_once dirname(__FILE__)."/../view/renderer.php";

function loadCalendar($server){
    if (isset($server['HTTP_AUTHENTICATE'])){
        require_once dirname(__FILE__)."/../model/service/calendarService.php";
        $result = GetFullCalendars($server['HTTP_AUTHENTICATE']);
        Renderer($result);
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}