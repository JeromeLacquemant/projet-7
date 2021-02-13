<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services\User;

use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use App\Services\User\UserOneLoader;
use Symfony\Component\Serializer\SerializerInterface;

class UserOneLoaderTest extends TestCase
{
    public function testUserOneLoader()
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->willReturn('{test}');

        $userRepository = $this->createMock(UserRepository::class);

        $classToTest = new UserOneLoader($userRepository, $serializer);

        $id = 5;

        $this->assertIsString($classToTest->loadOneUser($id));
    }
}