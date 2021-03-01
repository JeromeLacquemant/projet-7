<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Services\User\UserAllLoader;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class UserAllLoaderTest extends TestCase
{
    public function testUserAllLoader()
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $userRepository = $this->createMock(UserRepository::class);

        $security = $this->createMock(Security::class);

        $classToTest = new UserAllLoader($userRepository, $serializer, $security);

        $this->assertIsString($classToTest->loadAllUsers());
    }
}