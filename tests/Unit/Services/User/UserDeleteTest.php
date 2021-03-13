<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use App\Entity\User;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Services\User\UserDelete;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class UserDeleteTest extends TestCase
{
    public function testUserDelete()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager
            ->expects($this->once())
            ->method('remove');
        $entityManager
            ->expects($this->once())
            ->method('flush');

        $client = new Client();

        $user = new User();
            $user->setUsername("Daniel");
            $user->setPassword("password");
            $user->setEmail("mai@mail.com");
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

        $classToTest = new UserDelete($userRepository, $entityManager, $security);
        $id = 5;

        $this->assertTrue($classToTest->deleteUser($id));
    }
}