<?php

require "dbConnector.php";


function Ping(): void
{
    $mysqli = dbconnect();
    dbclose($mysqli);
    echo "pong";
}


?>