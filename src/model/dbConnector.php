<?php

function dbconnect()
{
    $hostname = "localhost";
    $username = "koppagenda";
    $password = "bouteille";
    $database = "koppagenda";

    try {
        $mysqli = new mysqli($hostname, $username, $password, $database);
    } catch (Exception $e) {
        //echo "Datablase is not available, please try again later <br>";
        echo "Error :" . $e->getMessage();
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