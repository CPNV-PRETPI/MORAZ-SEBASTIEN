<?php

function loadCalendar($server){

    if (isset($server['HTTP_AUTHENTICATE'])){
        require "model/requestCalendar.php";
        requestCalendar($server['HTTP_AUTHENTICATE']);
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}

