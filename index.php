<?php




if(isset($_GET["action"])){

    switch ($_GET["action"]){
        case "requestToken":
            if(isset($_POST["email"]) && isset($_POST["password"])){
                require_once "src/model/requestToken.php";
                requestToken($_POST["email"], $_POST["password"]);
            }

            break;
        default:
            echo "default";
            break;
    }
}

?>