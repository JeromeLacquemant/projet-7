<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSetTitle()
    {
        $classToTest = new User("username", "password", "email");

        $classToTest->setUsername("Daniel");
        $this->assertEquals('Daniel', $classToTest->getUsername());
    }

    public function testSetPassword()
    {
        $classToTest = new User("username", "password", "email");

        $classToTest->setPassword("password");
        $this->assertEquals('password', $classToTest->getPassword());
    }

    public function testSetEmail()
    {
        $classToTest = new User("username", "password", "email");

        $classToTest->setEmail("john@gmail.com");
        $this->assertEquals('john@gmail.com', $classToTest->getEmail());
    }

    public function testSetClient()
    {
        $classToTest = new User("username", "password", "email");
        $client = new Client();

        $classToTest->setClient($client);
        $this->assertEquals($client, $classToTest->getClient());
    }
}