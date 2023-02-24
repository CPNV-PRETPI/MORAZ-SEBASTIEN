<?php


namespace class;
use PDO;


class sqlServer
{
    private $mysqli;

    public function __construct()
    {
        try {
            $this->mysqli = new PDO('mysql:host=localhost;dbname=pretpi', 'pretpi', 'bouteille');

        }catch (\PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

    }


    public function GetData($request)
    {
        $stm = $this->mysqli->query($request);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>