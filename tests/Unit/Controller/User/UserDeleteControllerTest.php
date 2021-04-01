<?php

namespace App\Tests\Unit\Controller\User;

use App\Controller\User\UserDeleteController;
use App\Services\User\Interfaces\UserDeleteInterface;
use PHPUnit\Framework\TestCase;
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
