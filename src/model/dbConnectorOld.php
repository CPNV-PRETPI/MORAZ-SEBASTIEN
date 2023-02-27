<?php

function Dbconnect(string $config): mysqli
{
    #set fullpath dbConfig.json
    $fileConfig = json_decode(file_get_contents($config),true);

    $hostname = $fileConfig["host"];
    $username = $fileConfig["user"];
    $password = $fileConfig["password"];
    $database = $fileConfig["database"];

    try {
        $mysqli = new mysqli($hostname, $username, $password, $database);
    } catch (Exception $e) {
        //echo "Database is not available, please try again later <br>";
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

function Dbclose($mysqli)
{
    $mysqli->close();
}


?>