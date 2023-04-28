<?php

require_once dirname(__FILE__)."/../model/service/userService.php";
require_once dirname(__FILE__)."/../view/renderer.php";

function loadLogin($loginUserData, $server){
    if (isset($loginUserData['email']) && isset($loginUserData['password'])){
        $user = login(NULL,$loginUserData['email'],$loginUserData['password']);
        renderer($user->getUser());
    }elseif (isset($server['HTTP_AUTHENTICATE'])){
        $user = login($server['HTTP_AUTHENTICATE']);
        renderer($user->getUser());
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}
function loadRegister($registerUserData){
    if (isset($registerUserData['email']) && isset($registerUserData['password']) && isset($registerUserData['name'])){
        $user = register($registerUserData['email'],$registerUserData['password'],$registerUserData['name']);
        renderer($user->getUser());
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}