<?php

namespace test;


use Exception;
use PHPUnit\Framework\TestCase;
use User;
use Calendar;
use class\DbConnect;

require_once '../class/Calendar.php';
require_once '../class/User.php';
require_once '../class/DbConnect.php';

class UserTest extends TestCase
{
    private DbConnect|null $conn;

    protected function setUp(): void
    {
        $config = json_decode(file_get_contents('P:\MORAZ-SEBASTIEN\src\data\dbConfig.json'), true);
        $this->conn = new DbConnect($config["hostname"], $config["username"],$config["password"], $config["database"]);
    }
    
    public function test_requestTokenFromDb_notNull()
    {
        // Given
        $user = new User(NULL, 'testuser@exemple.com', '1234');

        // When
        $user->login();

        // Then
        $this->assertNotNull($user->getUserData());
    }

    public function test_requestTokenFromDB_throwException()
    {
        // Given
        $user = new User(NULL, 'testuser@exemple.com', '12346');

        // When


        // Then
        $this->expectException(Exception::class);
        $user->login();

    }

    public function test_requestCalendarValue_Equals()
    {
        // Given
        $result = '{"1":{"id":1,"title":"test1","description":"ceci est le test 1","events":[{"id":1,"title":"test1","description":"ce test 1","start":"2023-03-03 11:06:36","end":"2023-03-03 21:06:37","place":"ici"}]},"2":{"id":2,"title":"test2","description":"ceci est le test 2","events":[{"id":2,"title":"test2","description":"ce test 2","start":"2023-03-04 02:30:12","end":"2023-03-06 12:30:17","place":"la"}]}}';
        $user = new User(NULL, 'testuser@exemple.com', '1234');

        // When
        $user->login();
        $userData = $user->getUserData();
        $calendar = new Calendar($userData["token"]);

        // Then
        $this->assertEquals($result,json_encode($calendar->getCalendar()));
    }

    public function test_requestCalendarValue_throwException()
    {
        // Given
        $result = '{"1":{"id":1,"title":"test1","description":"ceci est le test 1","events":[{"id":1,"title":"test1","description":"ce test 1","start":"11:06:36","end":"21:06:37","place":"ici"}]},"2":{"id":2,"title":"test2","description":"ceci est le test 2","events":[{"id":2,"title":"test2","description":"ce test 2","start":"26:30:12","end":"84:30:17","place":"la"}]}}';
        $user = new User(NULL, 'testuser@exemple.com', '12345');

        // When


        // Then
        $this->expectException(Exception::class);
        $user->login();

    }

    public function test_registerInDatabase_notNull()
    {
        // Given
        try {
            $this->conn->executeQuery("DELETE FROM user WHERE email = 'testCreate@demo.com'");
        } catch (Exception $e) {
            // If the user doesn't exist, do nothing
        }
        $user = new User(NULL, 'testCreate@demo.com', '1234');

        // When
        $user->register("testCreate");

        // Then
        $this->assertNotNull($user->getUserData());
    }

    public function test_registerInDatabase_throwException()
    {
        // Given
        try {
            $this->conn->executeQuery("DELETE FROM user WHERE email = 'testCreate@demo.com'");
        } catch (Exception $e) {
            // If the user doesn't exist, do nothing
        }
        $user = new User(NULL, 'testCreate@demo.com', '1234');
        $user2 = new User(NULL, 'testCreate@demo.com', '12345');

        // When
        $user->register("testCreate");

        // Then
        $this->expectException(Exception::class);
        $user2->register("testCreate");
    }

    protected function tearDown(): void
    {
        try {
            $this->conn->executeQuery("DELETE FROM user WHERE email = 'testCreate@demo.com'");
        }catch (Exception $e){}
        $this->conn = null;
    }
}
