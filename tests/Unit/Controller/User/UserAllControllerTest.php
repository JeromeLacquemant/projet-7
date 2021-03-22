<?php

namespace App\Tests\Unit\User;

use PHPUnit\Framework\TestCase;
use App\Controller\User\UserAllController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\User\Interfaces\UserAllLoaderInterface;

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