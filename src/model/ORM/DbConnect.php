<?php

namespace model\class;

use PDO;
use PDOException;

class DbConnect
{
    private PDO $conn;

    public function __construct()
    {


        try {
            $this->conn = new PDO("mysql:host=" . $config["hostname"] . ";dbname=" . $config["database"], $config["username"], $config["password"]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo "Error :" . $e->getMessage();
        }
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
