<?php

include_once "src/model/dbConnector.php";


function Ping(): void
{
    $mysqli = dbconnect();
    dbclose($mysqli);
    echo "pong";
}


?>