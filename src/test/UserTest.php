<?php

namespace test;


use PHPUnit\Framework\TestCase;
use User;


require '../class/User.php';

class UserTest extends TestCase
{
    
    public function testRequestTokenFromDbSuccess()
    {
        $user = new User('testuser@exemple.com', '1234');
        $user->loadToken();

        $this->assertNotNull($user->getToken());

    }

    public function testRequestTokenFromDbFail()
    {
        $user = new User('testuser@exemple.com', '12346');
        $user->loadToken();

        $this->assertNull($user->getToken());

    }


}
