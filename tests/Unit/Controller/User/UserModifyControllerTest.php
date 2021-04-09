<?php

namespace App\Tests\Unit\Controller\User;

use PHPUnit\Framework\TestCase;
use App\Responder\JsonResponder;
use App\Controller\User\UserModifyController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\User\Interfaces\UserModifyInterface;

class UserModifyControllerTest extends TestCase
{
    public function testUserModifyController() 
    {
        $userModifyInterface = $this->createMock(UserModifyInterface::class);
        $userModifyInterface
            ->expects($this->once())
            ->method('modifyUser');
        
        $request = $this->createMock(Request::class);
            
        $jsonResponder = $this->createMock(JsonResponder::class);
        $jsonResponder
            ->expects($this->once())
            ->method('respond')
            ->willReturn(new JsonResponse);

        $classToTest = new UserModifyController($userModifyInterface, $jsonResponder);
        $id = 5;
        
        $this->assertInstanceOf(Response::class, $classToTest->modifyOneUser($id, $request));
    }
    
}