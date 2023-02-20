<?php

require "demo.php";
use PHPUnit\Framework\TestCase;

class DemoTest extends TestCase
{

    public function testGetTest2()
    {

        $demo = new Demo("oui", "non");
        $this->assertSame("non", $demo->GetTest2());

    }

    public function test__construct()
    {
        $demo = new Demo("oui", "non");
        $this->assertSame("oui", $demo->test1);
    }
}
