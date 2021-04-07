<?php

namespace App\Tests\Unit\User;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use App\Controller\User\UserOneController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\User\Interfaces\UserOneLoaderInterface;

class UserOneControllerTest extends TestCase
{
    public function testUserAllController() 
    {
        $loader = $this->createMock(UserOneLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadOneUser');

        $request = $this->createMock(Request::class);

        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new UserOneController($loader, $jsonResponder);
            
        $id = 5;
        
        $this->assertInstanceOf(JsonResponse::class, $classToTest->seeUser($id, $request));
    }
    
}