<?php

require "./class/demo.php";
use PHPUnit\Framework\TestCase;

class DemoTest extends TestCase
{

    public function test__construct()
    {
        $demo = new Demo("oui", "non");
        $this->assertSame("oui", $demo->test1);
    }

    public function testGetTest2()
    {
        $demo = new Demo("oui", "non");
        $this->assertSame("non", $demo->GetTest2());
    }
}
