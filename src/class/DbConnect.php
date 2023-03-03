<?php

namespace class;
use PDO;

class DbConnect
{
    private PDO $conn;
    private string $hostname;
    private string $username;
    private string $password;
    private string $database;

    public function __construct(string $hostname, string $username, string $password, string $database)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->dbConnect();
    }

    private function dbConnect(): void
    {
        $this->conn = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->username, $this->password);
    }

    public function executeQuery(string $query): bool|array
    {
        $stm = $this->conn->query($query);
        $result = $stm->fetchAll(PDO::FETCH_NUM);
        if ($result != null){
            return $result;
        }
        else{
            return false;
        }
    }
}


/*
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
*/

?>