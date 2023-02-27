<?php



function LoadPing(): void
{
    include_once "model/ping.php";
    Ping();
}


function LoadLogin($email, $password): void
{
    include_once "model/login.php";
    Login($email, $password);
}



?>