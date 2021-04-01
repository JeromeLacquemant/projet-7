<?php

namespace App\Tests\Unit\Controller\User;

use App\Controller\User\UserAllController;
use App\Services\User\Interfaces\UserAllLoaderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAllControllerTest extends TestCase
{
    public function testUserAllController()
    {
        $loader = $this->createMock(UserAllLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadAllUsers');

        $request = $this->createMock(Request::class);

        $classToTest = new UserAllController($loader);

        $this->assertInstanceOf(Response::class, $classToTest->seeUsers($request));
    }
}
