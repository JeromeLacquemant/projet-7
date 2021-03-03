<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testPassword()
    {
        $classToTest = new Client();

        $classToTest->setPassword("password");
        $this->assertEquals('password', $classToTest->getPassword());
    }

    public function testSetEmail()
    {
        $classToTest = new Client();

        $classToTest->setEmail("john@mail.com");
        $this->assertEquals('john@mail.com', $classToTest->getEmail());
    }

    public function testSetUsername()
    {
        $classToTest = new Client();

        $classToTest->setUsername("John");
        $this->assertEquals('John', $classToTest->getUsername());
    }
}