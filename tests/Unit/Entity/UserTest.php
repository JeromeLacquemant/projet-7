<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSetTitle()
    {
        $classToTest = new User();

        $classToTest->setUsername("Daniel");
        $this->assertEquals('Daniel', $classToTest->getUsername());
    }

    public function testSetPassword()
    {
        $classToTest = new User();

        $classToTest->setPassword("password");
        $this->assertEquals('password', $classToTest->getPassword());
    }

    public function testSetEmail()
    {
        $classToTest = new User();

        $classToTest->setEmail("john@gmail.com");
        $this->assertEquals('john@gmail.com', $classToTest->getEmail());
    }
}