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

    public function testRequestCalendarValueSuccess()
    {
        $result = '{"1":{"id":1,"title":"test1","description":"ceci est le test 1","events":[{"id":1,"title":"test1","description":"ce test 1","start":"11:06:36","end":"21:06:37","place":"ici"}]},"2":{"id":2,"title":"test2","description":"ceci est le test 2","events":[{"id":2,"title":"test2","description":"ce test 2","start":"26:30:12","end":"84:30:17","place":"la"}]}}';
        $user = new User(NULL, 'testuser@exemple.com', '1234');
        $user->login();
        $this->assertEquals($result,json_encode($user->getCalendar()));
    }

    public function testRequestCalendarValueFailed()
    {
        $result = '{"1":{"id":1,"title":"test1","description":"ceci est le test 1","events":[{"id":1,"title":"test1","description":"ce test 1","start":"11:06:36","end":"21:06:37","place":"ici"}]},"2":{"id":2,"title":"test2","description":"ceci est le test 2","events":[{"id":2,"title":"test2","description":"ce test 2","start":"26:30:12","end":"84:30:17","place":"la"}]}}';
        $user = new User(NULL, 'testuser@exemple.com', '12345');
        $user->login();
        $this->assertNotEquals($result,json_encode($user->getCalendar()));
    }

    public function testRegisterInDatabaseSuccess()
    {
        $user = new User(NULL, 'testCreate@demo.com', '1234');
        $user->register("testCreate");
        $this->assertNotNull($user->getUserData());

    }

}
