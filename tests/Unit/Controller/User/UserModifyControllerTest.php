<?php

namespace App\Tests\Unit\Controller\User;

use PHPUnit\Framework\TestCase;
use App\Controller\User\UserModifyController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $classToTest = new UserModifyController($userModifyInterface);
        $id = 5;
        
        $this->assertInstanceOf(Response::class, $classToTest->modifyOneUser($id, $request));
    }
    
}