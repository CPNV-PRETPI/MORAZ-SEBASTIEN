<?php

/*
 * Title: KoppaGenda
 * Author: Sébastien Moraz
 * Last Update: 05.03.2023
 * Version: 0.2
 */


if(isset($_GET["action"])){

    # Redirect to a good process
    switch ($_GET["action"]){
        case "login":
            if(isset($_POST["email"]) && isset($_POST["password"])){
                require_once "src/model/requestLogin.php";
                requestLogin(NULL, $_POST["email"], $_POST["password"]);
            }
            elseif (isset($_POST["token"])){
                require_once "src/model/requestLogin.php";
                requestLogin($_POST["token"], NULL, NULL);
            }else{
                echo json_encode("invalid parameters");
            }
            break;
            case "getCalendar":
                if(isset($_POST["token"])){
                    require_once "src/model/requestCalendar.php";
                    requestCalendar($_POST["token"]);

                }else{
                    echo json_encode("invalid parameters");
                }

            break;
            case "register":
                if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["name"])){
                    require_once "src/model/requestRegister.php";
                    requestRegister($_POST["email"], $_POST["password"], $_POST["name"]);
                }else{
                    echo json_encode("invalid parameters");
                }
            break;
        default:
            echo json_encode("Incorrect action");
            break;
    }
}

?>