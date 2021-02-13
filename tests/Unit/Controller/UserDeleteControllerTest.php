<?php

use PHPUnit\Framework\TestCase;
use App\Interfaces\UserDeleteInterface;
use App\Controller\User\UserDeleteController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDeleteControllerTest extends TestCase
{
    public function testUserDeleteController() 
    {
        $loader = $this->createMock(UserDeleteInterface::class);
        $loader
            ->expects($this->once())
            ->method('deleteUser');

        $classToTest = new UserDeleteController($loader);
        $id = 5;

        $this->assertInstanceOf(Response::class, $classToTest->deleteOneUser($id));
    }
    
}