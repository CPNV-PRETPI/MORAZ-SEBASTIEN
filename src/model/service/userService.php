<?php

use model\class\User;

require_once dirname(__FILE__)."/../entity/User.php";
require_once dirname(__FILE__)."/../ORM/dbConnector.php";

/**
 * @param string|NULL $token
 * @param string|null $email
 * @param string|null $password
 * @return void
 * @throws Exception
 */
function login(string $token = null, string $email = null, string $password = null): User
{
    if ($token == null && $email == null && $password == null) {
        http_response_code(400);
        throw new Exception("Invalid parameters");
    }
    if ($token != null && $email == null && $password == null) {
        return loginWithToken($token);
    }
    if ($token == null && $email != null && $password != null) {
        return loginWithEmail($email, $password);
    }
}

function loginWithEmail(string $email, string $password): User
{
    $hashed = hash('sha512', $password);
    $result = executeQuerySelect("SELECT token,name FROM user WHERE email = '$email' AND password = '$hashed'");
    if (empty($result)){
        http_response_code(401);
        throw new Exception("Invalid email or password");
    }
    return new User($result[0]["token"], $email, $result[0]["name"]);
}

function loginWithToken(string $token){
    $result = executeQuerySelect("SELECT email,name FROM user WHERE token = '$token'");
    if (empty($result)){
        http_response_code(401);
        throw new Exception("Invalid token");
    }
    return  new User($token, $result[0]["email"], $result[0]["name"]);
}

function register(string $email, string $password, string $name): User
{
    #check if email is a valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        http_response_code(400);
        throw new Exception("Invalid email");
    }
    executeQuerySelect("SELECT email FROM user WHERE email = '$email'");
    if (!empty($result)){
        http_response_code(400);
        throw new Exception("Email already used");
    }
    $hashed = hash('sha512', $password);
    do {
        $token = bin2hex(random_bytes(32));
    } while (executeQuerySelect("SELECT token FROM user WHERE token = '$token'") != null);
    $checkUserAlreadyExist = executeQuerySelect("SELECT email FROM user WHERE email = '$email'");
    if (!empty($checkUserAlreadyExist)){
        http_response_code(400);
        throw new Exception("Email already used");
    }
    executeQueryInsert("INSERT INTO user (email, name, password, token) VALUES ('$email', '$name', '$hashed', '$token')");
    return new User($token, $email, $name);
}