<?php

use PHPUnit\Framework\TestCase;
use App\Controller\UserOneController;
use App\Interfaces\UserOneLoaderInterface;
use Symfony\Component\HttpFoundation\Response;

class UserOneControllerTest extends TestCase
{
    public function testUserAllController() 
    {
        $loader = $this->createMock(UserOneLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadOneUser');

        $classToTest = new UserOneController($loader);
        $id = 5;
        
        $this->assertInstanceOf(Response::class, $classToTest->seeUser($id));
    }
    
}