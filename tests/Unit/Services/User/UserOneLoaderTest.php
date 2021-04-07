<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\Client;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Services\User\UserOneLoader;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class UserOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $client = new Client();

        $user = new User();
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

        $classToTest = new UserOneLoader($userRepository, $security);

        $id = 8;

        $this->assertInstanceOf(User::class, $classToTest->loadOneUser($id));
    }
}