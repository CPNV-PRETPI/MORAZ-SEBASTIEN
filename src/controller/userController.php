<?php


function loadLogin($loginUserData, $server){
    require "model/loginService.php";
    if (isset($loginUserData['email']) && isset($loginUserData['password'])){
        requestLoginWithEmail($loginUserData['email'],$loginUserData['password']);
    }elseif (isset($server['HTTP_AUTHENTICATE'])){
        requestLoginWithToken($server['HTTP_AUTHENTICATE']);
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}
function loadRegister($registerUserData){
    require "model/registerService.php";
    if (isset($registerUserData['email']) && isset($registerUserData['password']) && isset($registerUserData['name'])){
        requestRegister($registerUserData['email'],$registerUserData['password'],$registerUserData['name']);
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}