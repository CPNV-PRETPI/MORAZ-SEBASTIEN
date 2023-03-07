<?php

require "../model/requestLogin.php";
function requestLogin($loginUserData){
    if (isset($loginUserData['email']) && isset($loginUserData['password'])){
        requestLoginWithEmail($loginUserData['email'],$loginUserData['password']);
    }elseif (isset($loginUserData['token'])){
        requestLoginWithToken($loginUserData['token']);
    }else{
        throw new Exception("Invalid Authentication Method");
    }
}