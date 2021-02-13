<?php

use App\Controller\User\UserAllController;
use PHPUnit\Framework\TestCase;
use App\Interfaces\UserAllLoaderInterface;
use Symfony\Component\HttpFoundation\Response;

class UserAllControllerTest extends TestCase
{
    public function testUserAllController() 
    {
        $loader = $this->createMock(UserAllLoaderInterface::class);
        $loader
            ->expects($this->once())
            ->method('loadAllUsers');

        $classToTest = new UserAllController($loader);

        $this->assertInstanceOf(Response::class, $classToTest->seeUsers());
    }
    
}