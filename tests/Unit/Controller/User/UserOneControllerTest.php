<?php

namespace App\Tests\Unit\User;

use PHPUnit\Framework\TestCase;
use App\Controller\User\UserOneController;
use Symfony\Component\HttpFoundation\Response;
use App\Services\User\Interfaces\UserOneLoaderInterface;

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