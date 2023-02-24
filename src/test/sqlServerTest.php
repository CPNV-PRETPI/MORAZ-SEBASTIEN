<?php

namespace class;

require "../class/sqlServer.php";

use class\sqlServer;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class sqlServerTest extends TestCase
{

    public function test__construct()
    {
        $serversql = new sqlServer();
        $this->expectException(\PDOException::class);

    }

    public function testGetData()
    {
        $serversql = new sqlServer();
        $result = $serversql->GetData("SELECT `value` FROM demo WHERE  id=2;");
        $this->assertSame("non", $result[0]["value"]);
    }
}
