<?php

function loadCalendar($calendarData){
    require "model/requestCalendar.php";
    if (isset($calendarData['token'])){
        requestCalendar($calendarData['token']);
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}

