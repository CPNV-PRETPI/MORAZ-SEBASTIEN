<?php

include_once "src/model/dbConnector.php";

/**
 * @param $email
 * @param $password
 */
function Login($email, $password): void
{
    $hashed = hash('sha512', $password);
    $mysqli = dbconnect();
    $query = "SELECT token FROM user WHERE email = '$email' AND password = '$hashed'";
    $result = ExecuteQuery($mysqli, $query);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        echo $row["token"];
    }
    else{
        echo "login failed";
    }
    dbclose($mysqli);
}
?>