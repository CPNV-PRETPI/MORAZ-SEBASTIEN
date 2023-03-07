<?php

/*
 * Title: KoppaGenda
 * Author: Sébastien Moraz
 * Last Update: 05.03.2023
 * Version: 0.2
 */

if(isset($_GET["action"]) && isset($_POST)){

    switch ($_GET["action"]){
        case "login":
            require_once "src/controller/user.php";
            loadLogin($_POST);
            break;
        case "register":
            require_once "src/controller/user.php";
            loadRegister($_POST);
            break;
        case "getCalendar":
            require_once "src/controller/calendar.php";
            loadCalendar($_POST);
            break;
        default:
            echo json_encode("Incorrect action");
            break;
    }
}