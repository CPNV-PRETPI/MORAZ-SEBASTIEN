<?php




if(isset($_GET["action"])){

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
        default:
            echo "default";
            break;
    }
}

?>