<?php

namespace App\Tests\Unit\Controller\User;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use App\Controller\User\UserDeleteController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\User\Interfaces\UserDeleteInterface;

class UserDeleteControllerTest extends TestCase
{
    public function testUserDeleteController() 
    {
        $loader = $this->createMock(UserDeleteInterface::class);
        $loader
            ->expects($this->once())
            ->method('deleteUser');

        $request = $this->createMock(Request::class);

        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new UserDeleteController($loader, $jsonResponder);
        $id = 5;

        $this->assertInstanceOf(JsonResponse::class, $classToTest->deleteOneUser($id, $request));
    }
    
}