<?php

namespace App\Tests\Unit\Controller\User;

use App\Controller\User\UserAddController;
use App\Services\User\Interfaces\UserAddInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAddControllerTest extends TestCase
{
    public function testUserAddController()
    {
        $loader = $this->createMock(UserAddInterface::class);
        $loader
            ->expects($this->once())
            ->method('addUser');

        $request = $this->createMock(Request::class);

        $classToTest = new UserAddController($loader);

        $this->assertInstanceOf(Response::class, $classToTest->addOneUser($request));
    }
}
