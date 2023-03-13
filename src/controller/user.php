<?php


function loadLogin($loginUserData){
    require "model/requestLogin.php";
    if (isset($loginUserData['email']) && isset($loginUserData['password'])){
        requestLoginWithEmail($loginUserData['email'],$loginUserData['password']);
    }elseif (isset($loginUserData['token'])){
        requestLoginWithToken($loginUserData['token']);
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}
function loadRegister($registerUserData){
    require "model/requestRegister.php";
    if (isset($registerUserData['email']) && isset($registerUserData['password']) && isset($registerUserData['name'])){
        requestRegister($registerUserData['email'],$registerUserData['password'],$registerUserData['name']);
    }else{
        http_response_code(401);
        throw new Exception("Invalid Authentication Method");
    }
}