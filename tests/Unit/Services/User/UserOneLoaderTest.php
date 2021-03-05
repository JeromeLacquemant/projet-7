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

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $security = $this->createMock(Security::class);
        $security
            ->expects($this->once())
            ->method('getUser')
            ->willReturn($client);

        $classToTest = new UserOneLoader($userRepository, $serializer, $security);

        $id = 8;

        $this->assertIsString($classToTest->loadOneUser($id));
    }
}