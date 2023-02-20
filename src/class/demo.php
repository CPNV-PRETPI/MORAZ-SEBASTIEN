<?php

namespace class;
class Demo
{
    public $test1;
    private $test2;

    public function __construct($test1, $test2)
    {
        $this->test1 = $test1;
        $this->test2 = $test2;
    }

    public function GetTest2()
    {
        return $this->test2;
    }
}


?>