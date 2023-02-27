<?php


namespace test;

use class\DbConnect;
use PHPUnit\Framework\TestCase;

require "../class/DbConnect.php";

class DbConnectTest extends TestCase
{
    private DbConnect $sql;

    public function setUp(): void
    {
        parent::setUp();
        $config = json_decode(file_get_contents('../data/config.json'), true);
        $this->sql = new DbConnect($config["hostname"], $config["username"],$config["password"], $config["database"]);
    }

    public function testLoginSuccess()
    {
        $result = $this->sql->executeQuery("SELECT token FROM user WHERE email = '$email' AND password = '$hashed'");
        $this->assertEquals($this->sql, $result);
    }
}
