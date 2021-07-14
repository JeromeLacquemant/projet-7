<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\User;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Output\Outputs\UserOutput;
use App\Repository\UserRepository;
use App\Services\User\UserOneLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Output\OutputConstructors\UserOneOutputConstruction;

class UserOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $client = new Client();
        $userOutput = new UserOutput();

        $user = new User("username", "password", "email");
            $user->setUsername("Daniel");
            $user->setPassword("password");
            $user->setEmail("mai@ail.com");
            $user->setClient($client);

        $userRepository = $this->createMock(UserRepository::class);
            $userRepository
                ->expects($this->once())
                ->method('find')
                ->willReturn($user);   

        $security = $this->createMock(Security::class);
        $security
            ->expects($this->once())
            ->method('isGranted')
            ->willReturn(true);

        $request = $this->createMock(Request::class);

        $userOneOutputConstruction = $this->createMock(UserOneOutputConstruction::class);
        $userOneOutputConstruction
            ->expects($this->once())
            ->method('outputConstruction')
            ->willReturn($userOutput); 

        $classToTest = new UserOneLoader($userRepository, $security, $userOneOutputConstruction);
        $expected = [$userOutput, 200];
        $id = 1;

        $this->assertEquals($expected, $classToTest->loadOneUser($id, $request));
    }
}