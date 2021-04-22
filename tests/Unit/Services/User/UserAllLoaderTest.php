<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Services\User\UserAllLoader;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use App\Output\OutputConstructors\UserAllOutputConstruction;
use App\Output\Outputs\UserOutput;

class UserAllLoaderTest extends TestCase
{
    public function testUserAllLoader()
    {
        $userOutput = new UserOutput();

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->expects($this->once())
            ->method('getUsers')
            ->willReturn(new Paginator(1));

        $request = $this->createMock(Request::class);
        $request->query = new InputBag;

        $userAllOutputConstruction = $this->createMock(UserAllOutputConstruction::class);
        $userAllOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($userOutput); 

        $classToTest = new UserAllLoader($userRepository, $userAllOutputConstruction);

        $this->assertEquals($userOutput, $classToTest->loadAllUsers($request));
    }
}