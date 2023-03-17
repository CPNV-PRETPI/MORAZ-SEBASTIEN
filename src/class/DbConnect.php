<?php

namespace class;

use PDO;
use PDOException;

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
        try {
            $this->conn = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->username, $this->password);
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
