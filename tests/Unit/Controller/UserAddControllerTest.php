<?php

use PHPUnit\Framework\TestCase;
use App\Interfaces\UserAddInterface;

use App\Controller\UserAddController;
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