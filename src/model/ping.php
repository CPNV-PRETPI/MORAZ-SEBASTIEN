<?php

require "DbConnect.php";


function Ping(): void
{
    $mysqli = dbconnect();
    dbclose($mysqli);
    echo "pong";
}


?>