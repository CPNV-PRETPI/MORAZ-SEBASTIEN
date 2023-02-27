<?php

function dbconnect()
{
    #set fullpath dbConfig.json
    $fileConfig = json_decode(file_get_contents("C:\Users\sebastien.moraz\MORAZ-SEBASTIEN\src\data\dbConfig.json"),true);

    $hostname = $fileConfig["host"];
    $username = $fileConfig["user"];
    $password = $fileConfig["password"];
    $database = $fileConfig["database"];

    try {
        $mysqli = new mysqli($hostname, $username, $password, $database);
    } catch (Exception $e) {
        //echo "Datablase is not available, please try again later <br>";
        echo "Error :" . $e->getMessage();
        http_response_code(500);
    }
    return $mysqli;
}

function ExecuteQuery($mysqli, $query)
{
    $result = $mysqli->query($query);
    if (!$result) {
        echo "Query failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    return $result;
}

function ExecuteQueryNoResult($mysqli, $query)
{
    $result = $mysqli->query($query);
    if (!$result) {
        echo "Query failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
}

function dbclose($mysqli)
{
    $mysqli->close();
}


?>