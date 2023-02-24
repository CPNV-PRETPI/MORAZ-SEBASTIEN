<?php



function LoadPing(): void
{
    require "src/model/ping.php";
    Ping();
}


function LoadLogin($email, $password){
    require "src/model/login.php";
    Login($email, $password);
}



?>