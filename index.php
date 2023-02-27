<?php

include_once "src/controller.php";

if(isset($_GET["action"])){

    switch ($_GET["action"]){
        case "ping":
            LoadPing();
            break;
        case "login":
            if(isset($_POST["email"]) && isset($_POST["password"])){
                LoadLogin($_POST["email"], $_POST["password"]);
            }
            else{
                echo "error, you need to provide email and password (ex: ?action=login | POST (password, email)) ";

            }

            break;
        default:
            echo "default";
            break;
    }
}

?>