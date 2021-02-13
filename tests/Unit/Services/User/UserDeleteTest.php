<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use PHPUnit\Framework\TestCase;
use App\Services\User\UserDelete;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

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

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository
            ->expects($this->once())
            ->method('find');

        $classToTest = new UserDelete($userRepository, $entityManager);
        $id = 5;
        
        $this->assertTrue($classToTest->deleteUser($id));
    }
}