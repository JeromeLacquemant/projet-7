<?php

namespace App\Tests\Unit\Controller\User;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use App\Controller\User\UserAllController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new UserAllController($loader, $jsonResponder);

        $this->assertInstanceOf(JsonResponse::class, $classToTest->seeUsers($request));
    }
    
}