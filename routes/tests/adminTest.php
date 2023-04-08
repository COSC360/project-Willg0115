<?php

use PHPUnit\Framework\TestCase;

require_once '../shortcuts.php'; 

class UserTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=skiit', 'webuser', 'P@ssw0rd');
    }

    protected function tearDown(): void
    {
        $this->pdo = null;
    }

    public function testIsAdminReturnsTrueForAdminUser()
    {
        $username = 'will'; 
        $isAdmin = isAdmin($username, $this->pdo);
        $this->assertTrue($isAdmin);
    }

    public function testIsAdminReturnsFalseForNonAdminUser()
    {
        $username = 'test'; 
        $isAdmin = isAdmin($username, $this->pdo);
        $this->assertFalse($isAdmin);
    }

    public function testIsAdminReturnsFalseForNonExistentUser()
    {
        $username = 'nonexistentuser';
        $isAdmin = isAdmin($username, $this->pdo);
        $this->assertFalse($isAdmin);
    }
}
?>