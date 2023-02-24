<?php

include_once "src/controller.php";

if(isset($_GET["action"])){

    switch ($_GET["action"]){
        case "ping":
            LoadPing();
            break;
        case "login":
            if(isset($_GET["email"]) && isset($_GET["password"])){
                LoadLogin($_GET["email"], $_GET["password"]);
            }
            else{
                echo "error, you need to provide email and password (ex: ?action=login&email=\"email\"&password=\"password\") ";
            }

            break;
        default:
            echo "default";
            break;
    }
}

?>