<?php

use PHPUnit\Framework\TestCase;
use App\Interfaces\UserModifyInterface;
use App\Controller\UserModifyController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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