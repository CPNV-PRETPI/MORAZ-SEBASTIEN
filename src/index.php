<?php

/*
 * Title: KoppaGenda
 * Author: Sébastien Moraz
 * Last Update: 05.03.2023
 * Version: 0.2
 */

if(isset($_GET["action"])){

    switch ($_GET["action"]){
        case "getCalendar":
            require_once "controller/calendar.php";
            loadCalendar($_SERVER);
            break;
        case "login":
            require_once "controller/user.php";
            loadLogin($_POST, $_SERVER);
            break;
        case "register":
            require_once "controller/user.php";
            loadRegister($_POST);
            break;
        default:
            http_response_code(401);
            echo json_encode("Incorrect action");
            break;
    }
}