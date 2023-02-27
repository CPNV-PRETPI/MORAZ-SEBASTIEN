<?php

namespace test;

include_once "../controller.php";

use PHPUnit\Framework\TestCase;



class testDbConnectorOld extends TestCase
{

    public function testLoadPing_Noma()
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
