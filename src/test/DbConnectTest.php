<?php


namespace test;

use DbConnect;
use PHPUnit\Framework\TestCase;

require "../model/DbConnect.php";

class DbConnectTest extends TestCase
{

    public function testGetDbConnector()
    {
        $sql = new DbConnect("localhost", "koppagenda", "bouteille", "koppagenda");
        $result = $sql->getDbConnector();
        $this->assertEquals($result, $sql);
    }
}
