<?php

namespace test;

use Exception;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../model/service/userService.php';

class testUserService extends TestCase
{
    protected function setUp(): void
    {
        executeQuerySelect("DELETE FROM user WHERE email = 'testregister@exemple.com';");
    }
    public function testLoginWithTokenSuccess()
    {
        $user = login("exemple_token");
        $this->assertNotNull($user->getUser());
    }

    public function testLoginWithTokenFail()
    {
        $this->expectException(Exception::class);
        login("exemple_token_fail");
    }

    public function testLoginWithEmailSuccess()
    {
        $user = login(null, "testuser@exemple.com", "1234");
        $this->assertNotNull($user->getUser());
    }

    public function testLoginWithEmailFail()
    {
        $this->expectException(Exception::class);
        login(null, "testfail@exemple.com", "1234");
    }

    public function testRegisterSuccess()
    {
        $user = register("testregister@exemple.com", "1234", "testregister");
        $this->assertNotNull($user->getUser());
    }

    public function testRegisterFail()
    {
        $this->expectException(Exception::class);
        register("testuser@exemple.com", "1234", "testfailregister");
    }

    protected function tearDown(): void
    {
        executeQuerySelect("DELETE FROM user WHERE email = 'testregister@exemple.com';");
    }
}