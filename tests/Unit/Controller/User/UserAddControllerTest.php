<?php

namespace App\Tests\Unit\User;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use App\Controller\User\UserAddController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\User\Interfaces\UserAddInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserAddControllerTest extends TestCase
{
    public function testUserAddController() 
    {
        $loader = $this->createMock(UserAddInterface::class);
        $loader
            ->expects($this->once())
            ->method('addUser');
            
        $request = $this->createMock(Request::class);

        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new UserAddController($loader, $jsonResponder);
        
        $this->assertInstanceOf(JsonResponse::class, $classToTest->addOneUser($request));
    }
    
}