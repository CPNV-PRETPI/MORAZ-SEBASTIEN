<?php

namespace test;
require "../class/demo.php";

use class\Demo;
use PHPUnit\Framework\TestCase;

class demoTest extends TestCase
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
