<?php

namespace class;

include_once "../controller.php";

use PHPUnit\Framework\TestCase;



class testDbConnector extends TestCase
{

    public function testPing()
    {
        LoadPing();
        $this->expectOutputString("pong");
    }

    public function testLoginSuccess()
    {
        LoadLogin("testuser@exemple.com","1234");
        $this->expectOutputString('{"token":"exemple_tocken"}');
    }

    public function testLoginFailure()
    {
        LoadLogin("testuser@exemple.com","12345");
        $this->expectOutputString("login failed");
    }
}
