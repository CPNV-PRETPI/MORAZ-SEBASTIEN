<?php

namespace test;


use PHPUnit\Framework\TestCase;
use User;


require '../class/User.php';

class UserTest extends TestCase
{
    
    public function testRequestTokenFromDbSuccess()
    {
        $user = new User(NULL, 'testuser@exemple.com', '1234');
        $user->login();
        $this->assertNotNull($user->getUserData());
    }

    public function testRequestTokenFromDbFail()
    {
        $user = new User(NULL, 'testuser@exemple.com', '12346');
        $user->login();

        $this->assertNull($user->getUserData());

    }




}
